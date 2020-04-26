<?php

namespace Model;
use App\Config;
use PDO;

class Db{
    protected static $pdo;

    public static function getPDOInstance()
    {
        if(!isset(self::$pdo))
            self::$pdo = new PDO('sqlite:'.Config::SQLITE_NAME);
        return self::$pdo;
    }
}
