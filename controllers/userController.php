<?php

namespace app\controllers;

use app\src\Response;
use app\views\userDashboardView;

class userController
{
    public static function index() {
        $response = new Response();

        $response->setBody(userDashboardView::render());

        return $response;
    }

}