<?php

namespace app\views;

use app\views\layouts\mainLayout;

/**
 * @package app\views
 */
class tasksView
{
    public static function render($params = []){
        ob_start();
        ?>
        <?= mainLayout::renderHeader() ?>
        <h1>TASKS!</h1>
        <pre>
            <?= var_dump($params); ?>
        </pre>
        <?php

        $html = ob_get_clean();
        return $html;
    }
}