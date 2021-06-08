<?php


namespace App\Component;


class Db
{
    private static $host = '127.0.0.1';
    private static $db   = 'fastbank';
    private static $user = 'naesis';
    private static $pass = 'naesis';
    private static $charset = 'utf8';
    private static $pdo;

    public static function query($query, $bind=[])
    {
        if(!self::$pdo){
            self::connect();
        }
        $statment = self::$pdo->prepare($query);
        $statment->execute($bind);
        return $statment->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function insert($query, $bind=[])
    {
        if(!self::$pdo){
            self::connect();
        }
        $statment = self::$pdo->prepare($query);
        $statment->execute($bind);
        return true;
    }

    public static function beginTransaction()
    {
        if(!self::$pdo){
            self::connect();
        }
        self::$pdo->beginTransaction();
    }

    public static function commit()
    {
        if(!self::$pdo){
            self::connect();
        }
        self::$pdo->commit();
    }

    private static function connect()
    {
        $dsn = "mysql:host=".self::$host.";dbname=".self::$db.";charset=".self::$charset;
        $opt = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        self::$pdo = new \PDO($dsn, self::$user, self::$pass, $opt);
    }
}