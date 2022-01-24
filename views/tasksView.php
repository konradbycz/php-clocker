<?php

namespace app\views;

use app\views\layouts\mainLayout;
use app\models\Task;

/**
 * @package app\views
 */
class tasksView
{
    public static function render($tasks = [], $project = null){
        ob_start();
        ?>
        <?= mainLayout::renderHeader() ?>
        <div class="container">
            <!-- Project List Section -->
            <div class="row">
                <div class="col-10 col-s-8 offset-1 offset-s-2">
                    <h1 class="title"><?php echo $project->getName();?></h1>
                    <div class="fit-box">
                        <a href="index.php?page=add_task&project=<?php echo $project->getId();?>"><button class="action-button action-button-bigger">Add new task</button></a>
                    </div>
                    <div class="fit-box task-loader">
                        <!-- Nazwa klienta nazwa projektu -->
                        <?php
                        foreach ($tasks as $task) {
                            $taskTotalTime = $task->getTotalTime();

                            $totalTime = new \DateTime();
                            $totalTime->setTime(0, 0, $taskTotalTime);
                            $totalTime = $totalTime->format('H:i:s');

                            $taskName = $task->getName();
                            $taskId = $task->getId();
                            $desc = $task->getDescription();
                            echo "
                                    <div class='list-row-task' id='$taskId'>
                                        <div class='list-row-task-name'>$taskName</div>
                                        <div class='list-row-task-desc'>$desc</div>
                                        <div class='list-row-task-start' onclick='startSession($taskId)'>▶️</div>
                                        <div class='list-row-task-stop' onclick='stopSession($taskId)'>⏸️</div>
                                        <div class='list-row-task-end'>⏹️</div>
                                        <div class='list-row-task-timer'>$totalTime</div>
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