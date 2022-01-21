<?php

namespace app\controllers;

use app\models\Projects;
use app\src\Response;
use app\views\userDashboardView;

class userController
{
    public static function index() {
        $response = new Response();

        $projects = new Projects();
        $projects = $projects->getUserProjects($_SESSION['uid']);

        $response->setBody(userDashboardView::render($projects));

        return $response;
    }

}