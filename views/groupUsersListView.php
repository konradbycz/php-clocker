<?php

namespace app\views;

use app\views\layouts\mainLayout;

/**
 * @package app\views
 */
class groupUsersListView
{
    public static function render($users = [], $group = null) {
        $groupId = $group->getId();
        $groupName = $group->getName();
        ob_start();
        echo mainLayout::renderHeader();
        ?>
        <div class="container">
            <!-- Admin actions section -->
            <div class="row">
                <div class="col-8 col-s-8 offset-2 offset-s-2">
                    <h1 class="title">Manage group: <?php echo $groupName; ?></h1>
                    <div class="fit-box">
                        <a href="index.php?page=add_user_to_group&group=<?php echo $groupId;?>"><button class="action-button action-button-bigger">Add new user</button></a>
                    </div>

                    <div class="fit-box">
                        <?php

                        foreach ($users as $user){
                            $userId = $user->getId();
                            $userName = $user->getFirstname()." ".$user->getLastname();

                            echo "
                                <div class='list-row-reusable'>
                                    <div class='list-row-name-reusable'>$userName</div>
                                    <div class='list-row-delete-reusable'><a href='index.php?page=remove_user_from_group&group=$groupId&user=$userId'>🗑️</a></div>
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