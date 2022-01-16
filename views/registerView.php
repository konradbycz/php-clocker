<?php

namespace app\views;

use app\views\layouts\mainLayout;

/**
 * @package app\views
 */
class registerView
{
    public static function render($params = []){
        ob_start();
        ?>
        <?= mainLayout::renderHeader() ?>
        <div class="container">
            <!-- Register form section -->
            <div class="row">
                <div class="col-8 col-s-8 offset-2 offset-s-2">
                    <h1 class="title">Register</h1>
                    <form class="fit-box" action="?page=register" method="post">
                        <h2>Firstname</h2>
                        <input class="text-input" type="text" name="firstname">
                        <h2>Lastname</h2>
                        <input class="text-input" type="text" name="lastname">
                        <h2>Email</h2>
                        <input class="text-input" type="text" name="email">
                        <h2>Password</h2>
                        <input class="text-input" type="password" name="password">
                        <h2>Repeat password</h2>
                        <input class="text-input" type="password" name="confirmPassword">
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