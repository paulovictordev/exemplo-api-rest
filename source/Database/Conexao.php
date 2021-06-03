<?php

namespace Source\Database;

use \PDO;
use \PDOException;

class Conexao
{
    private const HOST = 'mysql-srv';
    private const DBNAME = 'dbapi';
    private const USER = 'root';
    private const PASSWD = 'root';

    private const OPTIONS = [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ];

    private static $instance;

    /**
     * @return PDO
     */
    public static function getInstance(): PDO
    {
        if (empty(self::$instance)) {
            try {
                self::$instance = new PDO(
                    "mysql:host=" . self::HOST. ";dbname=" . self::DBNAME,
                    self::USER,
                    self::PASSWD,
                    self::OPTIONS
                );
            } catch (PDOException $exception)  {
                echo "Erro ao Conectar"; die();
            }
        }

        return self::$instance;
    }

    final private function __construct() {}

    final private function __clone() {}
}