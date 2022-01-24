<?php

namespace app\views;

use app\models\Clients;
use app\models\Groups;
use app\views\layouts\mainLayout;

/**
 * @package app\views
 */
class projectListView
{
    public static function render($projects = []) {
        ob_start();
        echo mainLayout::renderHeader();
        ?>

        <div class="container">
            <div class="row">
                <div class="col-8 col-s-8 offset-2 offset-s-2">
                    <h1 class="title">Projects</h1>
                    <div class="fit-box">
                        <a href="index.php?page=add_project"><button class="action-button action-button-bigger">Add new project</button></a>
                    </div>
                    <div class="fit-box">
                        <?php

                        foreach ($projects as $project){
                            $projectId = $project->getId();
                            $projectName = $project->getName();
                            $projectClient = $project->getClientId();
                            $client = new Clients();
                            $clientName = $client->getClientById($projectClient)->getName();

                            $groups = new Groups();
                            $group = $groups->getGroupById($project->getGroupId());
                            $groupName = $group->getName();

                            echo "
                                <div class='list-row-project'>
                                    <a href='index.php?page=tasks&project=$projectId'>
                                        <div class='list-row-name'>$projectName</div>
                                    </a>
                                    <div class='list-row-group'>$groupName</div>
                                    <div class='list-row-client'>$clientName</div>
                                    <div class='list-row-delete-reusable'><a href='index.php?page=remove_project&project=$projectId'>🗑️</a></div>
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