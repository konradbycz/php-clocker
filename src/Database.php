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
        try {
            $this->connection = new PDO('mysql:dbname=clocker; host=localhost', 'root', '');
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