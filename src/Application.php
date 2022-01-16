<?php

namespace app\src;

use app\src\Router;

/**
 * @package app\src
 */
class Application
{
    public function run($path){
        list($controller, $functionName) = Router::resolve($path);

        return $controller::$functionName();
    }
}