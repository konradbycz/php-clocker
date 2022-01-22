<?php

namespace app\views;

use app\views\layouts\mainLayout;

/**
 * @package app\views
 */
class groupUsersListView
{
    public static function render($users = []) {
        ob_start();
        echo mainLayout::renderHeader();
        ?>
        <div class="container">
            <div class="row">
                <div class="col-8 col-s-8 offset-2 offset-s-2">
                    <h1 class="title">Group users</h1>
                    <div class="fit-box">
                        <?php

                        foreach ($users as $user){
                            $userId = $user->getId();
                            $userName = $user->getFirstname();

                            echo "
                                <div class='list-row'>
                                    <a href='#'>
                                        <div class='list-row-name'>$userName</div>
                                    </a>
                                </div>
                            ";
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $html = ob_get_clean();
        return $html;
    }
}