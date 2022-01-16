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
            $response->setHeaders('Location', 'index.php?page=tasks');
        }else{
            $response->setBody(homepageView::render());
        }
        return $response;
    }
}