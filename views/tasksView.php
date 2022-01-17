<?php

namespace app\views;

use app\views\layouts\mainLayout;
use app\models\Task;

/**
 * @package app\views
 */
class tasksView
{
    public static function render($tasks = []){
        ob_start();
        ?>
        <?= mainLayout::renderHeader() ?>
        <div class="container">
            <!-- Project List Section -->
            <div class="row">
                <div class="col-8 col-s-8 offset-2 offset-s-2">
                    <h1 class="title">&lt;Nazwa Projektu&gt; Tasks</h1>

                    <div class="fit-box">
                        <!-- Nazwa klienta nazwa projektu -->
                        <?php

                        foreach ($tasks as $task) {
                            $project = $task->getProject();
                            $desc = $task->getDescription();
                            echo "
                                    <div class='list-row-task'>
                                        <div class='list-row-task-name'>$project</div>
                                        <div class='list-row-task-desc'>$desc</div>
                                        <div class='list-row-task-start'>▶️</div>
                                        <div class='list-row-task-stop'>⏸️</div>
                                        <div class='list-row-task-end'>⏹️</div>
                                        <div class='list-row-task-timer'>00:00</div>
                                    </div>
                                ";
                        }

                        ?>
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