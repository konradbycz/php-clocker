<?php

namespace app\src;

use PDO;
use PDOException;
use app\config;
/**
 * @package app\src
 */
abstract class Database
{
    protected $connection;

    protected function openConnection(){

        $config = include('../config/config.php');

        try {
            $this->connection = new PDO($config['host'], $config['username'], $config['password']);
        }catch (PDOException $e) {
            echo "PDOException was caught: {$e->getMessage()}";
            var_dump($e->getTraceAsString());
        }
    }

    protected function closeConnection(){
        $this->connection = null;
    }

    abstract public function save($object);
}