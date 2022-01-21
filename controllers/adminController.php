<?php

namespace app\controllers;

use app\models\Projects;
use app\src\Response;
use app\views\adminDashboardView;

/**
 * @package app\controllers
 */
class adminController
{
    public static function index() {
        $response = new Response();

        $projects = new Projects();
        $projects = $projects->getUserProjects($_SESSION['uid']);

        $response->setBody(adminDashboardView::render($projects));

        return $response;
    }
}