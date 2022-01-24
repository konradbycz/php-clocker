<?php

namespace app\views;

use app\views\layouts\mainLayout;

/**
 * @package app\views
 */
class clientListView
{
    public static function render($clients = []) {
        ob_start();
        echo mainLayout::renderHeader();
        ?>

        <div class="container">
            <!-- Admin actions section -->
            <div class="row">
                <div class="col-8 col-s-8 offset-2 offset-s-2">
                    <h1 class="title">Manage clients</h1>
                    <div class="fit-box">
                        <a href="index.php?page=add_client"><button class="action-button action-button-bigger">Add new client</button></a>
                    </div>

                    <div class="fit-box">
                        <?php

                        foreach ($clients as $client){
                            $clientName = $client->getName();
                            $clientId = $client->getId();

                            echo "
                                <div class='list-row-reusable'>
                                    <div class='list-row-name-reusable'>$clientName</div>
                                    <div class='list-row-delete-reusable'><a href='index.php?page=remove_client&client=$clientId'>🗑️</a></div>
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