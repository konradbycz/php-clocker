<?php

namespace app\models;

use app\src\Database;
use app\models\Task;
use PDO;
use PDOException;

/**
 * @package app\models
 */

class Projects extends Database
{
    public function save($project)
    {
        $query = "INSERT INTO groups(ownerId, groupId, clientId, name) VALUES (:ownerId, :groupId, :clientId, :name)";
        $params = [
            'ownerId' => $project->getOwnerId(),
            'groupId' => $project->getGroupId(),
            'clientId' => $project->getClientId(),
            'name' => $project->getName()
        ];

        $this->openConnection();

        $statement = $this->connection->prepare($query);
        $statement->execute($params);

        $project->setId($this->connection->lastInsertId());

        $this->closeConnection();
        return $project;
    }

    public function getUserProjects($userId){
        $projects = [];
        $this->openConnection();

        $userGroups = new Groups();
        $userGroups = $userGroups->getUserGroups($userId);

        foreach ($userGroups as $group){
            $tmp = $this->getGroupProjects($group->getId());
            foreach ($tmp as $project){
                $projects[] = $project;
            }
        }

        $this->closeConnection();
        return $projects;
    }

    public function getGroupProjects($groupId){
        $projects = [];
        $this->openConnection();

        $query = "SELECT * FROM project WHERE groupId = :groupId";
        $statement = $this->connection->prepare($query);

        $statement->execute(array('groupId' => $groupId));
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $projects[] = $this->projectFromDB($row);
        }

        $this->closeConnection();
        return $projects;
    }

    public function projectFromDB($row){
        $project = new Project();

        $project
            ->setId($row['id'])
            ->setOwnerId($row['ownerId'])
            ->setGroupId($row['groupId'])
            ->setClientId($row['clientId'])
            ->setName($row['name']);
        return $project;
    }

    public function getUsers($projectId){
        $users = [];
        $this->openConnection();

        $groupId = $this->getProjectById($projectId)->getGroupId();
        $group = new Groups();
        $group = $group->getGroupUsers($groupId);

        foreach ($group as $groupUser){
            $users[] = $groupUser;
        }

        $this->closeConnection();
        return $users;
    }

    public function getProjectById($projectId){
        $this->openConnection();

        $query = "SELECT * FROM project WHERE id = :id";
        $statement = $this->connection->prepare($query);

        $statement->execute(array('id' => $projectId));
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $project = $this->projectFromDB($row);

        $this->closeConnection();
        return $project;
    }
}