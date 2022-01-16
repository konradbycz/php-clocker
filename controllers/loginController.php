<?php

namespace app\controllers;

use app\models\User;
use app\models\UserTable;
use app\src\Response;
use app\views\loginView;
/**
 * @package app\controllers
 */
class loginController
{
    public static function index(){
        $response = new Response();

        $response->setBody(loginView::render());

        return $response;
    }

    public static function login(){
        $response = new Response();

        $email = trim(htmlspecialchars($_POST['email']));
        $password = trim(htmlspecialchars($_POST['password']));

        if (empty($email) || empty($password)) {
            $response->setHeaders('Location', 'index.php?page=login');
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $response->setHeaders('Location', 'index.php?page=login');
        } else{
            $userTable = new UserTable();

            $user = $userTable->findEmail($email);
            if (!is_null($user)){
                if (!password_verify($password, $user->getHash())){
                    $response->setHeaders('Location', 'index.php?page=login');
                }else{
                    $_SESSION['uid'] = $user->getId();
                    $response->setHeaders('Location', 'index.php?page=tasks');
                }
            }else{
                $response->setHeaders('Location', 'index.php?page=login');
            }
        }
        return $response;
    }

    public static function logout(){
        $response = new Response();
        session_unset();
        $response->setHeaders('Location', 'index.php');
        return $response;
    }
}