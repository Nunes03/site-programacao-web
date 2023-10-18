<?php

namespace database;

use converters\interfaces\ConverterInterface;
use database\repositories\mysqli;

class ConnectionDatabase
{

    /**
     * @param $query string referente a query a ser executada.
     * @param $converter ConverterInterface usado para converter
     * o retorno da consulta.
     * @return mixed objeto definido pela classe converter.
     */
    public static function executeQuery($query, $converter)
    {
        $connection = ConnectionDatabase::getConnectionDatabase();
        $resultSet = $connection->query($query);
        $connection->close();

        return $converter->convert($resultSet);
    }

    private static function getConnectionDatabase()
    {
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $databaseName = "uniaservice";

        return new mysqli($hostname, $username, $password, $databaseName);
    }
}
