<?php

namespace crud\model;

use PDO;
use Exception;
include 'include/config.php';

class ClassConnection
{
    //Inicia conexao com banco de dados via PDO
    public static function getConnection()
    {
        try {
            return new PDO(DB_DRIVER . ':host=' . DB_HOST
             . ';dbname=' . DB_NAME , DB_USER , DB_PASSWORD);
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }
}
