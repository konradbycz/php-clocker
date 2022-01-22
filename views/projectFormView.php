<?php

namespace app\views;

use app\views\layouts\mainLayout;

/**
 * @package app\views
 */
class projectFormView
{
    public static function render($groups = [], $clients = []){
        ob_start();
        ?>
        <?= mainLayout::renderHeader() ?>
        <div class="container">
            <!-- Register form section -->
            <div class="row">
                <div class="col-8 col-s-8 offset-2 offset-s-2">
                    <h1 class="title">Project</h1>
                    <form class="fit-box" action="?page=add_project" method="post">
                        <h2>Project name</h2>
                        <input class="text-input" type="text" name="projectName">
                        <h2>Select group</h2>
                        <select name="groupId" id="groupId">
                            <?php
                                foreach ($groups as $group){
                                    $groupId = $group->getId();
                                    $groupName = $group->getName();
                                    echo "<option value='$groupId'>$groupName</option>";
                                }
                            ?>
                        </select>
                        <h2>Select client</h2>
                        <select name="clientId" id="clientId">
                            <?php
                            foreach ($clients as $client){
                                $clientId = $client->getId();
                                $clientName = $client->getName();
                                echo "<option value='$clientId'>$clientName</option>";
                            }
                            ?>
                        </select>
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