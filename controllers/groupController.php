<?php

namespace app\controllers;

use app\models\Groups;
use app\models\UserTable;
use app\src\Response;
use app\views\groupListView;
use app\views\groupFormView;
use app\models\Group;
use app\views\groupUsersListView;
use app\views\addUserFormView;

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
            $response->setBody(groupUsersListView::render($users, $groups->getGroupById($_GET['group'])));
        }
        return $response;
    }

    public static function addUserToGroup(){
        $response = new Response();

        $email = $_POST['email'];
        $groupId = $_GET['group'];

        if(!isset($email) || !isset($groupId)){
            $response->setHeaders('Location', 'index.php?page=manage_groups');
            return $response;
        }
        $users = new UserTable();
        $user = $users->findByEmail($email);

        if ($user === null){
            $response->setHeaders('Location', 'index.php?page=manage_groups');
            return $response;
        }
        $groups = new Groups();
        $group = $groups->getGroupById($groupId);

        if ($group === null){
            $response->setHeaders('Location', 'index.php?page=manage_groups');
            return $response;
        }

        $groups->addUserToGroup($user->getId(), $groupId);
        $response->setHeaders('Location', "index.php?page=manage_group&group=".$groupId);

        return $response;
    }

    public static function removeUserFromGroup(){
        $response = new Response();

        $groupId = $_GET['group'];
        $userId = $_GET['user'];

        if (!isset($groupId) || !isset($userId)){
            $response->setHeaders('Location', 'index.php?page=manage_groups');
            return $response;
        }

        $groups = new Groups();
        $users = new UserTable();
        $group = $groups->getGroupById($groupId);
        $user = $users->findById($userId);

        if ($user === null || $group === null){
            $response->setHeaders('Location', 'index.php?page=manage_groups');
            return $response;
        }

        $groups->removeUserFromGroup($userId, $groupId);

        $response->setHeaders('Location', 'index.php?page=manage_group&group='.$groupId);

        return $response;
    }

    public static function addUserForm(){
        $response = new Response();

        if (empty($_GET['group'])){
            $response->setHeaders('Location', 'index.php?page=manage_groups');
        }else{
            $groupId = $_GET['group'];
            $groups = new Groups();
            $group = $groups->getGroupById($groupId);

            if ($group === null){
                $response->setHeaders('Location', 'index.php?page=manage_groups');
            }else{
                $response->setBody(addUserFormView::render($group));
            }
        }
        return $response;
    }
}