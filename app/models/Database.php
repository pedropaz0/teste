<?php
class Database
{
    private static $pdo = null;

    public static function conectar()
    {
        if (self::$pdo === null) {
            $c = require __DIR__ . '/../config.php';
            self::$pdo = new PDO($c['dsn'], $c['usuario'], $c['senha'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        }
        return self::$pdo;
    }
}
