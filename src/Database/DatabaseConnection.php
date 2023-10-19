<?php

class DatabaseConnection
{
    public function __construct()
    {
    }

    public function executeQuery($query, $converter)
    {
        $connection = $this->getConnectionDatabase();
        $resultSet = mysqli_query($connection, $query);
        mysqli_close($connection);

        return $converter->convert($resultSet);
    }

    public function getConnectionDatabase()
    {
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $databaseName = "uniaservice";

        return mysqli_connect($hostname, $username, $password, $databaseName);
    }
}
?>