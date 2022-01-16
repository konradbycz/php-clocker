<?php

namespace app\models;

use app\src\Database;
use PDO;
use PDOException;

/**
 * @package app\models
 */
class UserTable extends Database
{
    public function save($user)
    {
        $query = "INSERT INTO user(firstname, lastname, email, hash, role) VALUES (:firstname, :lastname, :email, :hash, :role)";
        $params = [
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
            'hash' => $user->getHash(),
            'role' => $user->getRole()
        ];

        $this->openConnection();

        $statement = $this->connection->prepare($query);
        $statement->execute($params);

        $user->setId($this->connection->lastInsertId());

        $this->closeConnection();
        return $user;
    }

    public function findEmail($email){
        $this->openConnection();
        $query = "SELECT * FROM user WHERE email = :email";
        $statement = $this->connection->prepare($query);

        $statement->execute(array('email' => $email));
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$row){
            return null;
        }
        $user = $this->userFromDB($row);

        $this->closeConnection();
        return $user;
    }

    public function findId($id){
        $this->openConnection();
        $query = "SELECT * FROM user WHERE id = :id";
        $statement = $this->connection->prepare($query);

        $statement->execute(array('id' => $id));
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$row){
            return null;
        }
        $user = $this->userFromDB($row);

        $this->closeConnection();
        return $user;
    }

    public function userFromDB($row){
        $user = new User();

        $user
            ->setId($row['id'])
            ->setFirstname($row['firstname'])
            ->setLastname($row['lastname'])
            ->setEmail($row['email'])
            ->setHash($row['hash'])
            ->setRole($row['role']);
        return $user;
    }
}