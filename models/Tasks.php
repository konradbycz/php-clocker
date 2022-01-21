<?php

namespace app\models;

use app\src\Database;
use app\models\Task;
use PDO;
use PDOException;
/**
 * @package app\models
 */
class Tasks extends Database
{
    public function save($task){
        //
    }

    public function taskFromDB($row){
        $task = new Task();

        $task
            ->setId($row['id'])
            ->setUserId($row['userId'])
            ->setProjectId($row['projectId'])
            ->setName($row['name'])
            ->setStart($row['start'])
            ->setStop($row['stop'])
            ->setDescription($row['description']);
        return $task;
    }

    public function getUserTasks($userId){
        $tasks = [];
        $this->openConnection();

        $query = "SELECT * FROM task WHERE userId = :id";
        $statement = $this->connection->prepare($query);

        $statement->execute(array('id' => $userId));
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $tasks[] = $this->taskFromDB($row);
        }

        $this->closeConnection();
        return $tasks;
    }

    public function getProjectTasks($projectId){
        $tasks = [];
        $this->openConnection();

        $query = "SELECT * FROM task WHERE projectId = :projectId";
        $statement = $this->connection->prepare($query);

        $statement->execute(array('projectId' => $projectId));
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $tasks[] = $this->taskFromDB($row);
        }

        $this->closeConnection();
        return $tasks;
    }
}