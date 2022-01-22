<?php

namespace app\views;

use app\views\layouts\mainLayout;

/**
 * @package app\views
 */
class groupListView
{
    public static function render($groups = []) {
        ob_start();
        echo mainLayout::renderHeader();
        ?>

        <div class="container">
            <div class="row">
                <div class="col-8 col-s-8 offset-2 offset-s-2">
                    <h1 class="title">Groups</h1>
                    <a href="index.php?page=add_group">Dodaj grupe</a>
                    <div class="fit-box">
                        <?php

                        foreach ($groups as $group){
                            $groupId = $group->getId();
                            $groupName = $group->getName();

                            echo "
                                <div class='list-row'>
                                    <a href='index.php?page=manage_group&group=$groupId'>
                                        <div class='list-row-name'>$groupName</div>
                                    </a>
                                    <a href='index.php?page=remove_group&group=$groupId'>Usun grupe</a>
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