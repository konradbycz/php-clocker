<?php

namespace app\controllers;

use app\src\Response;
use app\views\adminDashboardView;

/**
 * @package app\controllers
 */
class adminController
{
    public static function index() {
        $response = new Response();

        $response->setBody(adminDashboardView::render());

        return $response;
    }
}