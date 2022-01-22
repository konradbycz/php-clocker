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
            <div class="row">
                <div class="col-8 col-s-8 offset-2 offset-s-2">
                    <h1 class="title">Clients</h1>
                    <a href="index.php?page=add_client">Dodaj klienta</a>
                    <div class="fit-box">
                        <?php

                        foreach ($clients as $client){
                            $clientName = $client->getName();
                            $clientId = $client->getId();

                            echo "
                                <div class='list-row'>
                                    <a href='#'>
                                        <div class='list-row-name'>$clientName</div>
                                    </a>
                                    <a href='index.php?page=remove_client&client=$clientId'>Usun klienta</a>
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