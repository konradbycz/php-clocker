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

        if($task->getId()) {
            $query = "UPDATE task SET userId = :userId, projectId = :projectId, name = :name, start = :start, stop = :stop, startSession = :startSession, totalTime = :totalTime, description = :description WHERE id = :taskId ";
            $params = [
                'taskId' => $task->getId(),
                'userId' => $task->getUserId(),
                'projectId' => $task->getProjectId(),
                'name' => $task->getName(),
                'start' => $task->getStart(),
                'stop' => $task->getStop(),
                'startSession' => $task->getStartSession(),
                'totalTime' => $task->getTotalTime(),
                'description' => $task->getDescription()
            ];

            $this->openConnection();

            $statement = $this->connection->prepare($query);
            $statement->execute($params);

            $this->closeConnection();
            return $task;
        }

        $query = "INSERT INTO task(userId, projectId, name, start, stop, description) VALUES (:userId, :projectId, :name, :start, :stop, :description)";
        $params = [
            'userId' => $task->getUserId(),
            'projectId' => $task->getProjectId(),
            'name' => $task->getName(),
            'start' => $task->getStart(),
            'stop' => $task->getStop(),
            'description' => $task->getDescription()
        ];

        $this->openConnection();

        $statement = $this->connection->prepare($query);
        $statement->execute($params);

        $task->setId($this->connection->lastInsertId());

        $this->closeConnection();
        return $task;
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
            ->setStartSession($row['startSession'])
            ->setTotalTime($row['totalTime'])
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

    public function getTaskById($taskId){
        $this->openConnection();

        $query = "SELECT * FROM task WHERE id = :id";
        $statement = $this->connection->prepare($query);

        $statement->execute(array('id' => $taskId));
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if(!$row) {
            return null;
        }

        $task = $this->taskFromDB($row);

        $this->closeConnection();
        return $task;
    }
}