<?php

namespace app\views\layouts;

/**
 * @package  app\views\layouts
 */
class mainLayout
{
    public static function renderHeader($params = []){
        if (isset($_SESSION['uid'])){
            if ($_SESSION['role'] === 'admin'){
                return self::adminHeader();
            }else{
                return self::userHeader();
            }
        }else {
            return self::header();
        }
    }

    public static function header($params = []){
        ob_start();
        ?>
        <!DOCTYPE html>
        <html lang="pl">
        <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width" />
        <title>Clocker</title>
        </head>
        <body>
            <nav>
                <a href="index.php" class="logo">Clocker</a>
                <a href="index.php" class="nav-link"><span class="active-link slide-animation">Home</span></a>
                <a href="?page=login" class="nav-link"><span class="slide-animation">Log in</span></a>
                <a href="?page=register" class="nav-link"><span class="slide-animation">Register</span></a>
                <!--<a href="?page=admin_dashboard" class="nav-link"><span class="slide-animation">PANEL ADMINA</span></a>-->
            </nav>
        <?php
        $html = ob_get_clean();
        return $html;
    }

    public static function userHeader($params = []){
        ob_start();
        ?>
        <!DOCTYPE html>
        <html lang="pl">
        <head>
            <meta charset="UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width" />
            <title>Clocker</title>
        </head>
        <body>
            <nav>
                <a href="index.php" class="logo">Clocker</a>
                <a href="index.php" class="nav-link"><span class="active-link slide-animation">Home</span></a>
                <a href="?page=logout">Logout</a>
                <!--<a href="?page=admin_dashboard" class="nav-link"><span class="slide-animation">PANEL ADMINA</span></a>-->
            </nav>
        <?php
        $html = ob_get_clean();
        return $html;
    }

    public static function adminHeader($params = []){
        ob_start();
        ?>
        <!DOCTYPE html>
        <html lang="pl">
        <head>
            <meta charset="UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width" />
            <title>Clocker</title>
        </head>
        <body>
        <nav>
            <a href="index.php" class="logo">Clocker</a>
            <a href="index.php" class="nav-link"><span class="active-link slide-animation">Home</span></a>
            <a href="?page=admin_dashboard" class="nav-link"><span class="slide-animation">PANEL ADMINA</span></a>
            <a href="?page=logout">Logout</a>
        </nav>
        <?php
        $html = ob_get_clean();
        return $html;
    }
}