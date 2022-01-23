<?php

namespace app\models;

use app\src\Database;
use PDO;
use PDOException;

/**
 * @package app\models
 */
class Groups extends Database
{
    public function save($group)
    {
        $query = "INSERT INTO groups(ownerId, name) VALUES (:ownerId, :name)";
        $params = [
            'ownerId' => $group->getOwnerId(),
            'name' => $group->getName()
        ];

        $this->openConnection();

        $statement = $this->connection->prepare($query);
        $statement->execute($params);

        $group->setId($this->connection->lastInsertId());

        $this->closeConnection();
        return $group;
    }

    public function groupFromDB($row){
        $group = new Group();

        $group
            ->setId($row['id'])
            ->setOwnerId($row['ownerId'])
            ->setName($row['name']);
        return $group;
    }

    public function getUserGroups($userId){
        $groups = [];
        $this->openConnection();

        $query = "SELECT * FROM usersgroups WHERE userId = :userId";
        $statement = $this->connection->prepare($query);

        $statement->execute(array('userId' => $userId));
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $group = $this->getGroupById($row['groupId']);
            $groups[] = $group;
        }

        $this->closeConnection();
        return $groups;
    }

    public function getGroupById($groupId){
        $this->openConnection();

        $query = "SELECT * FROM groups WHERE id = :groupId";
        $statement = $this->connection->prepare($query);

        $statement->execute(array('groupId' => $groupId));
        if ($statement->rowCount() === 0){
            return null;
        }
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $group = $this->groupFromDB($row);

        $this->closeConnection();
        return $group;
    }

    public function getGroupUsers($groupId){
        $users = [];
        $this->openConnection();

        $query = "SELECT * FROM usersgroups WHERE groupId = :groupId";
        $statement = $this->connection->prepare($query);

        $statement->execute(array('groupId' => $groupId));
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $users[] = $row['userId'];
        }

        $this->closeConnection();
        return $users;
    }

    public function getGroupByName($name){
        $this->openConnection();

        $query = "SELECT * FROM groups WHERE name = :name";
        $statement = $this->connection->prepare($query);

        $statement->execute(array('name' => $name));
        if ($statement->rowCount() === 0){
            return null;
        }
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $group = $this->groupFromDB($row);

        $this->closeConnection();
        return $group;
    }

    public function addUserToGroup($userId, $groupId){
        $this->openConnection();

        $query = "INSERT INTO usersgroups(groupId, userId) VALUES (:groupId, :userId)";
        $params = [
            'groupId' => $groupId,
            'userId' => $userId
        ];

        $statement = $this->connection->prepare($query);
        $statement->execute($params);

        $this->closeConnection();
    }

    public function removeUserFromGroup($userId, $groupId){
        $this->openConnection();

        $query = "DELETE FROM usersgroups WHERE userId=:userId AND groupId=:groupId";
        $params = [
            'userId' => $userId,
            'groupId' => $groupId
        ];

        $statement = $this->connection->prepare($query);
        $statement->execute($params);

        $this->closeConnection();
    }

    public function remove($group){
        $this->openConnection();

        if ($group->getId() === null){
            return;
        }

        $query = "DELETE FROM groups WHERE id = :id";
        $statement = $this->connection->prepare($query);
        $statement->execute(array('id' => $group->getId()));

        $query = "DELETE FROM usersgroups WHERE groupId = :groupId";
        $statement = $this->connection->prepare($query);
        $statement->execute(array('groupId' => $group->getId()));

        $this->closeConnection();
    }
}