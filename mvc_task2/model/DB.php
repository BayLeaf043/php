<?php
class DB {
    public static function pdo(): PDO {
        // шлях до файлу БД: mvc/data/library.db
        $dsn = 'sqlite:' . __DIR__ . '/../data/library.db';
        $pdo = new PDO($dsn);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('PRAGMA foreign_keys = ON');
        return $pdo;
    }
}
?>