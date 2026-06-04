<?php

class Config
{
    public static function conexaoPDO(): object
    {
        $db_host = 'localhost';
        $db_name = 'jabulanidb';
        $db_user = 'root';
        $db_pass = '';

        try {
            $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;

        } catch (PDOException $e) {
            echo 'Conexão Falhou:' . $e->getMessage();
            throw $e;
        }
    }
}
