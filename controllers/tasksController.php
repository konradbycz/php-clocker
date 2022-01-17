<?php

namespace app\controllers;

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

        $userId = $_SESSION['uid'];
        $user = new UserTable();
        $user = $user->findById($userId);

        $tasks = new Tasks();
        $tasks = $tasks->getUserTasks($user);

        $response->setBody(tasksView::render($tasks));

        return $response;
    }
}