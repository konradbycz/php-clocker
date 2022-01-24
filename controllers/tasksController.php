<?php

namespace app\controllers;

use app\models\Project;
use app\models\Projects;
use app\models\Task;
use app\models\Tasks;
use app\models\UserTable;
use app\src\Response;
use app\views\tasksView;
use app\views\addTaskFormView;
/**
 * @package app\controllers
 */
class tasksController
{
    public static function index(){
        $response = new Response();

        if (isset($_GET['project'])){
            $projects = new Projects();
            $userId = $_SESSION['uid'];
            $projectId = $_GET['project'];
            $users = $projects->getUsers($projectId);

            if (!in_array($userId, $users)){
                $response->setHeaders('Location', 'index.php');
            }

            $userTasks = [];

            $tasks = new Tasks();
            $projectTasks = $tasks->getProjectTasks($projectId);

            foreach ($projectTasks as $task){
                if ($task->getUserId() === $userId || $_SESSION['role'] === 'admin'){
                    $userTasks[] = $task;
                }
            }
            $project = $projects->getProjectById($projectId);
            $response->setBody(tasksView::render($userTasks, $project));
        }else{
            $response->setHeaders('Location', 'index.php');
        }

        return $response;
    }

    public static function addTaskForm(){
        $response = new Response();

        $projectId = $_GET['project'];

        if (!isset($projectId)){
            $response->setHeaders('Location', 'index.php');
            return $response;
        }

        $response->setBody(addTaskFormView::render($projectId));

        return $response;
    }

    public static function addTask(){
        $response = new Response();

        $userId = $_SESSION['uid'];
        $projectId = $_GET['project'];
        $name = $_POST['name'];
        $description = $_POST['description'];

        if (!isset($userId) || !isset($projectId) || !isset($name) || !isset($description)){
            $response->setHeaders('Location', 'index.php');
            return $response;
        }

        $users = new UserTable();
        $projects = new Projects();
        $user = $users->findById($userId);
        $project = $projects->getProjectById($projectId);

        if ($user === null || $project === null){
            $response->setHeaders('Location', 'index.php');
            return $response;
        }

        if (!in_array($project, $projects->getUserProjects($userId))){
            $response->setHeaders('Location', 'index.php');
            return $response;
        }

        $task = new Task();
        $tasks = new Tasks();
        $task
            ->setUserId($userId)
            ->setProjectId($projectId)
            ->setName($name)
            ->setStart(null)
            ->setStop(null)
            ->setDescription($description);

        $tasks->save($task);

        $response->setHeaders('Location', 'index.php?page=tasks&project='.$projectId);

        return $response;
    }

    public static function startSession() {
        $response = new Response();
        $response->setHeaders('Content-Type', "application/json");

        if(!isset($_GET['task'])) {
            $json = [
                "msg" => "No task id"
            ];
            $response->setBody(json_encode($json));
            return $response;
        }

        $taskId = $_GET['task'];
        $tasks = new Tasks();
        $task = $tasks->getTaskById($taskId);

        if($task === null) {
            $json = [
                "msg" => "Invalid task id"
            ];
            $response->setBody(json_encode($json));
            return $response;
        }

        if($task->getStartSession() !== null) {
            $json = [
                "msg" => "Already started session"
            ];
            $response->setBody(json_encode($json));
            return $response;
        }

        $task->setStartSession(time());
        $task = $tasks->save($task);

        $json = [
            "startTime" => $task->getStartSession(),
            "totalTime" => $task->getTotalTime()
        ];

        $response->setBody(json_encode($json));
        return $response;
    }

    public static function stopSession() {
        $response = new Response();
        $response->setHeaders('Content-Type', "application/json");

        if(!isset($_GET['task'])) {
            $json = [
                "msg" => "No task id"
            ];
            $response->setBody(json_encode($json));
            return $response;
        }

        $taskId = $_GET['task'];
        $tasks = new Tasks();
        $task = $tasks->getTaskById($taskId);

        if($task === null) {
            $json = [
                "msg" => "Invalid task id"
            ];
            $response->setBody(json_encode($json));
            return $response;
        }

        if($task->getStartSession() === null) {
            $json = [
                "msg" => "Already stopped session"
            ];
            $response->setBody(json_encode($json));
            return $response;
        }

        $stopTime = time();
        $diff = $stopTime - $task->getStartSession();
        $totalTime = $task->getTotalTime() + $diff;

        $task->setTotalTime($totalTime);
        $task->setStartSession(null);
        $task = $tasks->save($task);

        $json = [
            "startTime" => $task->getStartSession(),
            "totalTime" => $task->getTotalTime()
        ];

        $response->setBody(json_encode($json));
        return $response;
    }

    public static function getSessionTime() {
        $response = new Response();
        $response->setHeaders('Content-Type', "application/json");

        if(!isset($_GET['task'])) {
            $json = [
                "msg" => "No task id"
            ];
            $response->setBody(json_encode($json));
            return $response;
        }

        $taskId = $_GET['task'];
        $tasks = new Tasks();
        $task = $tasks->getTaskById($taskId);

        if($task === null) {
            $json = [
                "msg" => "Invalid task id"
            ];
            $response->setBody(json_encode($json));
            return $response;
        }

        $json = [
            "startTime" => $task->getStartSession(),
            "totalTime" => $task->getTotalTime()
        ];

        $response->setBody(json_encode($json));
        return $response;
    }
}