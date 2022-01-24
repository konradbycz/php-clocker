<?php

namespace app\views;

use app\views\layouts\mainLayout;

/**
 * @package app\views
 */
class clientFormView
{
    public static function render($params = []){
        ob_start();
        ?>
        <?= mainLayout::renderHeader() ?>
        <div class="container">
            <!-- Register form section -->
            <div class="row">
                <div class="col-8 col-s-8 offset-2 offset-s-2">
                    <h1 class="title">Add new client</h1>
                    <form class="fit-box" action="?page=add_client" method="post">
                        <h2>Name</h2>
                        <input class="text-input" type="text" name="clientName">
                        <input class="submit-input" type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
        <?php
        $html = ob_get_clean();
        return $html;
    }
}