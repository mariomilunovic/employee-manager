<?php

namespace App\database;

class DB 
{
    public const DSN = "mysql:host=mysql;dbname=employee-manager;charset=utf8mb4";
    public const DB_USER = 'employee-manager';
    public const DB_PASSWORD = 'secret';           
    public const DB_OPTIONS = [
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    public \PDO $pdo;
    
    private static $instance;

    private function __construct()
    {     
        $this->pdo = new \PDO(self::DSN, self::DB_USER, self::DB_PASSWORD, self::DB_OPTIONS);
    }

    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }

}