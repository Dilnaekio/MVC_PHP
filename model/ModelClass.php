<?php

abstract class Model
{
    private static $pdo;

    private function setBdd()
    {
        self::$pdo = new PDO('mysql:host=localhost;dbname=mvc_guilhaume;charset=utf8', 'root', '');
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    protected function getBdd()
    {
        if (self::$pdo === null) {
            $this->setBdd();
            return self::$pdo;
        } else {
            return self::$pdo;
        }
    }
}
