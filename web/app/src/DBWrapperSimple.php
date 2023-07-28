<?php

namespace App;

use PDO;

class DBWrapperSimple
{
    protected static  PDO $instance;

    public static function getInstance(): PDO
    {
        if (!isset(self::$instance)) {
            self::$instance = new PDO(
                'mysql:host=mysql;dbname=test',
                'root',
                'root'
            );
        }

        return self::$instance;
    }
}