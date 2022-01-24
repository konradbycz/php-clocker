<?php

namespace app\views\layouts;

/**
 * @package  app\views\layouts
 */
class mainLayout
{
    public static function renderHeader($params = []){
        ob_start();
        ?>
        <!DOCTYPE html>
        <html lang="pl">
        <head>
            <meta charset="UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width" />
            <title>Clocker</title>
            <link rel="icon" href="./img/clock-favi-svg.svg" type="image/x-icon" />
            <link rel="stylesheet" href="./style/style.css">

            <script src="./src/index.js" defer></script>
            <script src="./src/getTaskData.js"></script>
        </head>
        <body onload="getData()">

            <!-- Background animation -->
            <div class="bg"></div>
            <div class="bg bg2"></div>
            <div class="bg bg3"></div>
        <?php
        if (isset($_SESSION['uid'])){
            if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'){
                echo self::adminHeader();
            }else{
                echo self::userHeader();
            }
        }else {
            echo self::header();
        }

        $html = ob_get_clean();
        return $html;
    }

    public static function header($params = []){
        ob_start();
        ?>
            <nav>
                <a href="index.php" class="logo">Clocker</a>
                <a href="index.php" class="nav-link"><span class="active-link slide-animation">Home</span></a>
                <a href="?page=login" class="nav-link"><span class="slide-animation">Log in</span></a>
                <a href="?page=register" class="nav-link"><span class="slide-animation">Register</span></a>
            </nav>
        <?php
        $html = ob_get_clean();
        return $html;
    }

    public static function userHeader($params = []){
        ob_start();
        ?>
            <nav>
                <a href="index.php" class="logo">Clocker</a>
                <a href="index.php" class="nav-link"><span class="active-link slide-animation">Home</span></a>
                <a href="?page=logout" class="nav-link"><span class="slide-animation">Logout</a>
            </nav>
        <?php
        $html = ob_get_clean();
        return $html;
    }

    public static function adminHeader($params = []){
        ob_start();
        ?>
        <nav>
            <a href="index.php" class="logo">Clocker</a>
            <a href="index.php" class="nav-link"><span class="active-link slide-animation">Home</span></a>
            <a href="?page=logout" class="nav-link"><span class="slide-animation">Logout</a>
        </nav>
        <?php
        $html = ob_get_clean();
        return $html;
    }
}