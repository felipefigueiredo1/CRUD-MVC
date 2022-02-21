<?php

namespace crud\model;

use PDO;
use Exception;
include 'include/config.php';

class ClassConexao
{
    public static function pegaConexao()
    {
        try {
            return new PDO(DB_DRIVER . ':host=' . DB_HOST
             . ';dbname=' . DB_NAME , DB_USER , DB_PASSWORD);
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }
}
