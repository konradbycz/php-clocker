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
            <!-- Admin actions section -->
            <div class="row">
                <div class="col-8 col-s-8 offset-2 offset-s-2">
                    <h1 class="title">Manage groups</h1>
                    <div class="fit-box">
                        <a href="index.php?page=add_group"><button class="action-button action-button-bigger">Add new group</button></a>
                    </div>

                    <div class="fit-box">
                        <?php

                        foreach ($groups as $group){
                            $groupId = $group->getId();
                            $groupName = $group->getName();

                            echo "
                                <div class='list-row-reusable'>
                                    <div class='list-row-name-reusable'>$groupName</div>
                                    <div class='list-row-edit-reusable'><a href='index.php?page=manage_group&group=$groupId'>✏️</a></div>
                                    <div class='list-row-delete-reusable'><a href='index.php?page=remove_group&group=$groupId'>🗑️</a></div>
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