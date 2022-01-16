<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\src\Application;

session_start();
$path = isset($_GET['page']) ? $_GET['page'] : null;

$app = new Application();
$response = $app->run($path);
$response->send();