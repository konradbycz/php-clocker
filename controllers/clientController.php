<?php

namespace app\controllers;

use app\models\Client;
use app\models\Clients;
use app\src\Response;
use app\views\clientListView;
use app\views\clientFormView;
/**
 * @package app\controllers
 */
class clientController
{
    public static function index() {
        $response = new Response();

        $clients = new Clients();
        $clients = $clients->getClients($_SESSION['uid']);

        $response->setBody(clientListView::render($clients));

        return $response;
    }

    public static function clientForm(){
        $response = new Response();

        $response->setBody(clientFormView::render());

        return $response;
    }

    public static function addClient(){
        $response = new Response();

        $ownerId = $_SESSION['uid'];
        $clientName = $_POST['clientName'];

        $clients = new Clients();
        if (!isset($clientName)){
            $response->setHeaders('Location', 'index.php');
        } else if ($clients->getClientByName($clientName) !== null){
            $response->setHeaders('Location', 'index.php');
        } else{
            $client = new Client();
            $client
                ->setUserId($ownerId)
                ->setName($clientName);

            $clients->save($client);

            $response->setHeaders('Location', 'index.php?page=manage_clients');
        }
        return $response;
    }

    public static function removeClient(){
        $response = new Response();

        if (empty($_GET['client'])){
            $response->setHeaders('Location', 'index.php');
        }else{
            $clients = new Clients();
            $client = $clients->getClientById($_GET['client']);
            if ($_SESSION['uid'] === $client->getUserId()){
                $clients->remove($client);

                $response->setHeaders('Location', 'index.php?page=manage_clients');
            }else{
                $response->setHeaders('Location', 'index.php');
            }
        }


        return $response;
    }
}