<?php

namespace app\views;

use app\views\layouts\mainLayout;

/**
 * @package app\views
 */
class homepageView
{
    public static function render($params = []){
        ob_start();
        echo mainLayout::renderHeader();
        $html = ob_get_clean();
        return $html;
    }
}