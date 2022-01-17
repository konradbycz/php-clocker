<?php

namespace app\views;

use app\views\layouts\mainLayout;

/**
 * @package app\views
 */
class homepageView
{
    public static function render($params = []){
        ob_start();
        echo mainLayout::renderHeader();
        ?>
        <!-- Main content -->

        <div class="container">
            <!-- About section -->
            <div class="row">
                <div class="col-8 col-s-8 offset-2 offset-s-2">
                    <h1 class="title">What is clocker?</h1>
                    <p class="fit-box">
                        Clocker is an application that ensures that there is your working
                        time for developers and entire development teams. At the beginning
                        of the total working hours, you can check the commitment of
                        employees, as well as the task performance for their work has been
                        calculated. On our website it is also possible to obtain help from
                        project or customer statistics.
                    </p>
                </div>
            </div>

            <!-- Counters section -->
            <div class="row">
                <div class="col-2 col-s-2 offset-3 card">
                    <img class="svg-icon" src="./img/user-svg.svg" />
                    <h1 class="counter"><span class="count-up">35</span> users</h1>
                </div>
                <div class="col-2 col-s-2 card">
                    <img class="svg-icon" src="./img/day-svg.svg" />
                    <h1 class="counter"><span class="count-up">4</span> hours today</h1>
                </div>
                <div class="col-2 col-s-2 card">
                    <img class="svg-icon" src="./img/month-svg.svg" />
                    <h1 class="counter">
                        <span class="count-up">52</span> hours this month
                    </h1>
                </div>
            </div>
        </div>
        <?php
        $html = ob_get_clean();
        return $html;
    }
}