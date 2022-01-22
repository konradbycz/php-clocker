<?php

namespace app\controllers;

use app\models\Groups;
use app\models\UserTable;
use app\src\Response;
use app\views\groupListView;
use app\views\groupFormView;
use app\models\Group;
use app\views\groupUsersListView;

/**
 * @package app\controllers
 */
class groupController
{
    public static function index() {
        $response = new Response();

        $groups = new Groups();
        $groups = $groups->getUserGroups($_SESSION['uid']);

        $response->setBody(groupListView::render($groups));

        return $response;
    }

    public static function addGroup(){
        $response = new Response();

        $ownerId = $_SESSION['uid'];
        $groupName = $_POST['groupName'];

        $groups = new Groups();
        if (!isset($groupName)){
            $response->setHeaders('Location', 'index.php');
        } else if ($groups->getGroupByName($groupName) !== null){
            $response->setHeaders('Location', 'index.php');
        } else{
            $group = new Group();
            $group
                ->setOwnerId($ownerId)
                ->setName($groupName);

            $group = $groups->save($group);
            $groups->addUserToGroup($ownerId, $group->getId());

            $response->setHeaders('Location', 'index.php?page=manage_groups');
        }
        return $response;
    }

    public static function groupForm(){
        $response = new Response();

        $response->setBody(groupFormView::render());

        return $response;
    }

    public static function removeGroup(){
        $response = new Response();

        if (empty($_GET['group'])){
            $response->setHeaders('Location', 'index.php');
        }else{
            $groups = new Groups();
            $group = $groups->getGroupById($_GET['group']);
            if ($_SESSION['uid'] === $group->getOwnerId()){
                $groups->remove($group);

                $response->setHeaders('Location', 'index.php?page=manage_groups');
            }else{
                $response->setHeaders('Location', 'index.php');
            }
        }


        return $response;
    }

    public static function view(){
        $response = new Response();

        if (empty($_GET['group'])){
            $response->setHeaders('Location', 'index.php');
        }else{
            $users = [];
            $groups = new Groups();
            $userIds = $groups->getGroupUsers($_GET['group']);

            $userRepo = new UserTable();
            foreach ($userIds as $userId) {
                $users[] = $userRepo->findById($userId);
            }
            $response->setBody(groupUsersListView::render($users));
        }
        return $response;
    }
}