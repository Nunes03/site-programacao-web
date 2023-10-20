<?php

class DatabaseConnection
{

    public static function executeQuery($query)
    {
        $connection = self::getConnectionDatabase();
        $resultSet = mysqli_query($connection, $query);
        mysqli_close($connection);

        return $resultSet;
    }

    private static function getConnectionDatabase()
    {
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $databaseName = "uniaservice";
    
       return mysqli_connect($hostname, $username, $password, $databaseName);
    }
}
