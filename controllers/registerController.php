<?php

namespace app\controllers;

use app\models\User;
use app\models\UserTable;
use app\src\Response;
use app\views\registerView;
/**
 * @package app\controllers
 */
class registerController
{
    public static function index(){
        $response = new Response();

        $response->setBody(registerView::render());

        return $response;
    }

    public static function register(){
        $response = new Response();

        $firstname = trim(htmlspecialchars($_POST['firstname']));
        $lastname = trim(htmlspecialchars($_POST['lastname']));
        $email = trim(htmlspecialchars($_POST['email']));
        $password = trim(htmlspecialchars($_POST['password']));
        $confirmPassword = trim(htmlspecialchars($_POST['confirmPassword']));

        if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirmPassword)){
            $response->setHeaders('Location', 'index.php?page=register');
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $response->setHeaders('Location', 'index.php?page=register');
        } else if (strlen($password) < 6){
            $response->setHeaders('Location', 'index.php?page=register');
        } else if ($password !== $confirmPassword){
            $response->setHeaders('Location', 'index.php?page=register');
        } else{
            $userTable = new UserTable();

            $user = $userTable->findByEmail($email);
            if (!is_null($user)){
                $response->setHeaders('Location', 'index.php?page=register');
            }else{
                $user = new User();
                $user
                    ->setFirstname($firstname)
                    ->setLastname($lastname)
                    ->setEmail($email)
                    ->setHash(password_hash($password, PASSWORD_BCRYPT))
                    ->setRole('user');

                $newUser = $userTable->save($user);

                $_SESSION['uid'] = $newUser->getId();
                $response->setHeaders('Location', 'index.php');
            }
        }
        return $response;
    }
}