<?php

namespace app\views;

use app\views\layouts\mainLayout;

/**
 * @package app\views
 */
class addUserFormView
{
    public static function render($group = null){
        ob_start();
        ?>
        <?= mainLayout::renderHeader() ?>
        <div class="container">
            <!-- Register form section -->
            <?php
                $groupId = $group->getId();
                echo "
                    <div class='row'>
                        <div class='col-8 col-s-8 offset-2 offset-s-2'>
                            <h1 class='title'>Dodaj uzytkownika</h1>
                            <form class='fit-box' action='?page=add_user_to_group&group=$groupId' method='post'>
                                <h2>Email</h2>
                                <input class='text-input' type='text' name='email'>
                                <input class='submit-input' type='submit' value='Submit'>
                            </form>
                        </div>
                    </div>
                ";
            ?>

        </div>
        <?php
        $html = ob_get_clean();
        return $html;
    }
}