<?php
/**
 * Created by PhpStorm.
 * User: Fabio Botelho
 * Date: 09/05/2019
 * Time: 16:04
 */

namespace Source\Core;


use Source\Support\Message;

class Connect
{
    private const OPTIONS = [
        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", // UTF8 nos dados
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,     // tipo de erros retornados da PDO
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,  // tipo de retorno sempre em objetos
        \PDO::ATTR_CASE => \PDO::CASE_NATURAL              // não altera o nome das tabelas
    ];


    /**
     * @var \PDO
     */
    private static $instance;

    public static function getInstance(): \PDO
    {
        if (empty(self::$instance)) {
            try {
                self::$instance = new \PDO(
                    "mysql:host=" . CONF_DB_HOST . ";dbname=" . CONF_DB_NAME,
                    CONF_DB_USER,
                    CONF_DB_PASS,
                    self::OPTIONS
                );
            } catch (\PDOException $exception) {
                $message = new Message();
                echo $message->error("Erro ao conectar")->render();
                die();
            }
        }

        return self::$instance;
    }
}