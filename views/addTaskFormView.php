<?php

namespace app\views;

use app\views\layouts\mainLayout;

/**
 * @package app\views
 */
class addTaskFormView
{
    public static function render($projectId = null){
        ob_start();
        ?>
        <?= mainLayout::renderHeader() ?>
        <div class="container">
            <!-- Register form section -->
            <?php
            echo "
                    <div class='row'>
                        <div class='col-8 col-s-8 offset-2 offset-s-2'>
                            <h1 class='title'>Add task</h1>
                            <form class='fit-box' action='index.php?page=add_task&project=$projectId' method='post'>
                                <h2>Name</h2>
                                <input class='text-input' type='text' name='name'>
                                <h2>Description</h2>
                                <input class='text-input' type='text' name='description'>
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