<?php

namespace app\views;

use app\models\Clients;
use app\views\layouts\mainLayout;

/**
 * @package app\views
 */
class userDashboardView
{
    public static function render($projects = []) {
        ob_start();
        echo mainLayout::renderHeader();
        ?>
        <div class="container">
            <!-- Admin actions section -->
            <div class="row">
                <div class="col-8 col-s-8 offset-2 offset-s-2">
                    <h1 class="title">User Dashboard</h1>
                    <div class="fit-box fit-box-row">
                        <button class="action-button">
                            <img class="button-svg" src="../img/person-svg.svg" />Manage
                            account
                        </button>
                        <button class="action-button">
                            <img class="button-svg" src="../img/report-svg.svg" />Generate
                            report
                        </button>
                    </div>
                </div>
            </div>
            <!-- Project List Section -->
            <div class="row">
                <div class="col-8 col-s-8 offset-2 offset-s-2">
                    <h1 class="title">Projects</h1>
                    <div class="fit-box">
                    <?php

                        foreach ($projects as $project){
                            $projectName = $project->getName();
                            $projectClient = $project->getClientId();
                            $client = new Clients();
                            $clientName = $client->getClientById($projectClient)->getName();

                            echo "
                                <div class='list-row'>
                                    <a href='index.php?page=tasks&project=$projectClient'>
                                        <div class='list-row-name'>$projectName</div>
                                    </a>
                                    <div class='list-row-author'>$clientName</div>
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