<?php

namespace app\views;

use app\views\layouts\mainLayout;

/**
 * @package app\views
 */
class adminDashboardView
{
    public static function render($params = []) {
        ob_start();
        echo mainLayout::renderHeader();
        ?>

        <div class="container">
            <!-- Admin actions section -->
            <div class="row">
                <div class="col-8 col-s-8 offset-2 offset-s-2">
                    <h1 class="title">Admin Dashboard</h1>
                    <p class="fit-box fit-box-row">
                        <button class="action-button"><img class="button-svg" src="../img/person-svg.svg">Manage users</button>
                        <button class="action-button"><img class="button-svg" src="../img/group-svg.svg">Manage groups</button>
                        <button class="action-button"><img class="button-svg" src="../img/person-svg.svg">Manage clients</button>
                        <button class="action-button"><img class="button-svg" src="../img/task-svg.svg">Manage projects</button>
                        <button class="action-button"><img class="button-svg" src="../img/report-svg.svg">Generate report</button>
                    </p>
                </div>
            </div>
        </div>
    <?php
        $html = ob_get_clean();
        return $html;
    }
}