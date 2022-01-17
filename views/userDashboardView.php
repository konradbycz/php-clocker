<?php

namespace app\views;

use app\views\layouts\mainLayout;

/**
 * @package app\views
 */
class userDashboardView
{
    public static function render($params = []) {
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
                        <!-- Nazwa klienta nazwa projektu -->
                        <div class="list-row">
                            <a href="index.php?page=tasks">
                                <div class="list-row-name">IDelivery Project</div>
                            </a>
                            <div class="list-row-author">ZUT</div>
                        </div>
                        <div class="list-row">
                            <a href="index.php?page=tasks">
                                <div class="list-row-name">Storage Project</div>
                            </a>
                            <div class="list-row-author">TopTal</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $html = ob_get_clean();
        return $html;
    }
}