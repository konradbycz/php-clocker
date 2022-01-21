<?php

namespace app\controllers;

use app\models\Projects;
use app\models\Tasks;
use app\models\UserTable;
use app\src\Response;
use app\views\tasksView;
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
                if ($task->getUserId() === $userId){
                    $userTasks[] = $task;
                }
            }

            $response->setBody(tasksView::render($userTasks));
        }else{
            $response->setHeaders('Location', 'index.php');
        }

        return $response;
    }
}