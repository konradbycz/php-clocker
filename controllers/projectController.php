<?php

namespace app\controllers;

use app\models\Clients;
use app\models\Groups;
use app\models\Project;
use app\models\Projects;
use app\src\Response;
use app\views\projectListView;
use app\views\projectFormView;

/**
 * @package app\controllers
 */
class projectController
{
    public static function index() {
        $response = new Response();

        $projects = new Projects();
        $projects = $projects->getUserProjects($_SESSION['uid']);

        $response->setBody(projectListView::render($projects));

        return $response;
    }

    public static function projectForm(){
        $response = new Response();

        $groups = new Groups();
        $groups = $groups->getUserGroups($_SESSION['uid']);

        $clients = new Clients();
        $clients = $clients->getClients($_SESSION['uid']);

        $response->setBody(projectFormView::render($groups, $clients));

        return $response;
    }

    public static function addProject(){
        $response = new Response();

        $ownerId = $_SESSION['uid'];
        $projectName = $_POST['projectName'];
        $groupId = $_POST['groupId'];
        $clientId = $_POST['clientId'];

        $projects = new Projects();
        if (!isset($projectName)){
            $response->setHeaders('Location', 'index.php');
        } else if ($projects->getProjectByName($projectName) !== null){
            $response->setHeaders('Location', 'index.php');
        } else{
            $project = new Project();
            $project
                ->setOwnerId($ownerId)
                ->setGroupId($groupId)
                ->setClientId($clientId)
                ->setName($projectName);

            $projects->save($project);

            $response->setHeaders('Location', 'index.php?page=manage_projects');
        }
        return $response;
    }

    public static function removeProject(){
        $response = new Response();

        if (empty($_GET['project'])){
            $response->setHeaders('Location', 'index.php');
        }else{
            $projects = new Projects();
            $project = $projects->getProjectById($_GET['project']);
            if ($_SESSION['uid'] === $project->getOwnerId()){
                $projects->remove($project);

                $response->setHeaders('Location', 'index.php?page=manage_projects');
            }else{
                $response->setHeaders('Location', 'index.php');
            }
        }


        return $response;
    }
}