<?php

namespace app\models;

use app\src\Database;
use PDO;
use PDOException;

/**
 * @package app\models
 */
class Clients extends Database
{
    public function save($client)
    {
        $query = "INSERT INTO client(userId, name) VALUES (:userId, :name)";
        $params = [
            'userId' => $client->getUserId(),
            'name' => $client->getName()
        ];

        $this->openConnection();

        $statement = $this->connection->prepare($query);
        $statement->execute($params);

        $client->setId($this->connection->lastInsertId());

        $this->closeConnection();
        return $client;
    }

    public function clientFromDB($row){
        $client = new Client();

        $client
            ->setId($row['id'])
            ->setUserId($row['userId'])
            ->setName($row['name']);
        return $client;
    }

    public function getClientById($clientId){
        $this->openConnection();

        $query = "SELECT * FROM client WHERE id = :id";
        $statement = $this->connection->prepare($query);

        $statement->execute(array('id' => $clientId));
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $client = $this->clientFromDB($row);

        $this->closeConnection();
        return $client;
    }

    public function getClients($userId){
        $clients = [];
        $this->openConnection();

        $query = "SELECT * FROM client WHERE userId = :userId";
        $statement = $this->connection->prepare($query);

        $statement->execute(array('userId' => $userId));
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $clients[] = $this->clientFromDB($row);
        }

        $this->closeConnection();
        return $clients;
    }

    public function getClientByName($clientName){
        $this->openConnection();

        $query = "SELECT * FROM client WHERE name = :name";
        $statement = $this->connection->prepare($query);

        $statement->execute(array('name' => $clientName));
        if ($statement->rowCount() === 0){
            return null;
        }
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $client = $this->clientFromDB($row);

        $this->closeConnection();
        return $client;
    }

    public function remove($client){
        $this->openConnection();

        if ($client->getId() === null){
            return;
        }

        $query = "DELETE FROM client WHERE id = :id";
        $statement = $this->connection->prepare($query);
        $statement->execute(array('id' => $client->getId()));

        $this->closeConnection();
    }
}