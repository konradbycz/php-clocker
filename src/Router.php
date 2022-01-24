<?php

namespace app\src;

use app\controllers\clientController;
use app\controllers\groupController;
use app\controllers\projectController;
use app\controllers\registerController;
use app\controllers\loginController;
use app\controllers\tasksController;

/**
 * @package app\src
 */
class Router
{
    public static function resolve($path){
        switch ($path){
            case 'register':
                if (!empty($_POST['email'])){
                    $controller = registerController::class;
                    $functionName = 'register';
                    break;
                }
                $controller = 'app\controllers\registerController';
                $functionName = 'index';
                break;

            case 'login':
                if (!empty($_POST['email'])){
                    $controller = loginController::class;
                    $functionName = 'login';
                    break;
                }
                $controller = 'app\controllers\loginController';
                $functionName = 'index';
                break;

            case 'logout':
                if (isset($_SESSION['uid'])){
                    $controller = 'app\controllers\loginController';
                    $functionName = 'logout';
                    break;
                }
                $controller = 'app\controllers\homepageController';
                $functionName = 'index';
                break;

            case 'user_dashboard':
                if(isset($_SESSION['role']) && $_SESSION['role'] === 'user') {
                    $controller = 'app\controllers\userController';
                    $functionName = "index";
                } else {
                    $controller = 'app\controllers\homepageController';
                    $functionName = 'index';
                }
                break;

            case 'tasks':
                if (isset($_SESSION['uid'])){
                    $controller = 'app\controllers\tasksController';
                    $functionName = 'index';
                    break;
                }
                $controller = 'app\controllers\homepageController';
                $functionName = 'index';
                break;

            case 'add_task':
                if (isset($_SESSION['uid'])){
                    if(!empty($_POST['name'])){
                        $controller = tasksController::class;
                        $functionName = "addTask";
                        break;
                    }
                    $controller = 'app\controllers\tasksController';
                    $functionName = 'addTaskForm';
                    break;
                }
                $controller = 'app\controllers\homepageController';
                $functionName = 'index';
                break;

            case 'admin_dashboard':
                if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                    $controller = 'app\controllers\adminController';
                    $functionName = "index";
                } else {
                    $controller = 'app\controllers\homepageController';
                    $functionName = 'index';
                }
                break;

            case 'manage_projects':
                if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                    $controller = 'app\controllers\projectController';
                    $functionName = "index";
                } else {
                    $controller = 'app\controllers\homepageController';
                    $functionName = 'index';
                }
                break;

            case 'manage_groups':
                if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                    $controller = 'app\controllers\groupController';
                    $functionName = "index";
                } else {
                    $controller = 'app\controllers\homepageController';
                    $functionName = 'index';
                }
                break;

            case 'manage_group':
                if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                    $controller = 'app\controllers\groupController';
                    $functionName = "view";
                } else {
                    $controller = 'app\controllers\homepageController';
                    $functionName = 'index';
                }
                break;

            case 'add_user_to_group':
                if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                    if(!empty($_POST['email'])){
                        $controller = groupController::class;
                        $functionName = "addUserToGroup";
                        break;
                    }
                    $controller = 'app\controllers\groupController';
                    $functionName = "addUserForm";
                } else {
                    $controller = 'app\controllers\homepageController';
                    $functionName = 'index';
                }
                break;

            case 'remove_user_from_group':
                if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                    $controller = 'app\controllers\groupController';
                    $functionName = "removeUserFromGroup";
                    break;
                }
                $controller = 'app\controllers\homepageController';
                $functionName = 'index';

                break;

            case 'manage_clients':
                if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                    $controller = 'app\controllers\clientController';
                    $functionName = "index";
                } else {
                    $controller = 'app\controllers\homepageController';
                    $functionName = 'index';
                }
                break;

            case 'add_group':
                if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                    if(!empty($_POST['groupName'])){
                        $controller = groupController::class;
                        $functionName = "addGroup";
                        break;
                    }
                    $controller = 'app\controllers\groupController';
                    $functionName = "groupForm";
                } else {
                    $controller = 'app\controllers\homepageController';
                    $functionName = 'index';
                }
                break;

            case 'remove_group':
                if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                    $controller = 'app\controllers\groupController';
                    $functionName = "removeGroup";
                } else {
                    $controller = 'app\controllers\homepageController';
                    $functionName = 'index';
                }
                break;

            case 'add_client':
                if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                    if(!empty($_POST['clientName'])){
                        $controller = clientController::class;
                        $functionName = "addClient";
                        break;
                    }
                    $controller = 'app\controllers\clientController';
                    $functionName = "clientForm";
                } else {
                    $controller = 'app\controllers\homepageController';
                    $functionName = 'index';
                }
                break;

            case 'remove_client':
                if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                    $controller = 'app\controllers\clientController';
                    $functionName = "removeClient";
                } else {
                    $controller = 'app\controllers\homepageController';
                    $functionName = 'index';
                }
                break;

            case 'add_project':
                if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                    if(!empty($_POST['projectName'])){
                        $controller = projectController::class;
                        $functionName = "addProject";
                        break;
                    }
                    $controller = 'app\controllers\projectController';
                    $functionName = "projectForm";
                } else {
                    $controller = 'app\controllers\homepageController';
                    $functionName = 'index';
                }
                break;

            case 'remove_project':
                if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                    $controller = 'app\controllers\projectController';
                    $functionName = "removeProject";
                } else {
                    $controller = 'app\controllers\homepageController';
                    $functionName = 'index';
                }
                break;

            case 'start_session':
                if (isset($_SESSION['uid'])){
                    $controller = 'app\controllers\tasksController';
                    $functionName = 'startSession';
                    break;
                }
                $controller = 'app\controllers\homepageController';
                $functionName = 'index';
                break;

            case 'stop_session':
                if (isset($_SESSION['uid'])){
                    $controller = 'app\controllers\tasksController';
                    $functionName = 'stopSession';
                    break;
                }
                $controller = 'app\controllers\homepageController';
                $functionName = 'index';
                break;

            case 'get_session_time':
                if (isset($_SESSION['uid'])){
                    $controller = 'app\controllers\tasksController';
                    $functionName = 'getSessionTime';
                    break;
                }
                $controller = 'app\controllers\homepageController';
                $functionName = 'index';
                break;


            default:
                $controller = 'app\controllers\homepageController';
                $functionName = 'index';
                break;
        }
        return [$controller, $functionName];
    }
}