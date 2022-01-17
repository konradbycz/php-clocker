<?php

namespace app\controllers;

use app\src\Response;
use app\views\homepageView;

/**
 * @package app\controllers
 */
class homepageController
{
    public static function index(){
        $response = new Response();

        if (isset($_SESSION['uid'])){
            if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                $response->setHeaders('Location', 'index.php?page=admin_dashboard');
            } else {
                $response->setHeaders('Location', 'index.php?page=user_dashboard');
            }
        }else{
            $response->setBody(homepageView::render());
        }
        return $response;
    }
}