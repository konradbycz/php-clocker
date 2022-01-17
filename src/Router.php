<?php

namespace app\src;

use app\controllers\registerController;
use app\controllers\loginController;
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
                if (isset($_SESSION['uid']) && $_SESSION['role'] === 'user'){
                    $controller = 'app\controllers\tasksController';
                    $functionName = 'index';
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

            default:
                $controller = 'app\controllers\homepageController';
                $functionName = 'index';
                break;
        }
        return [$controller, $functionName];
    }
}