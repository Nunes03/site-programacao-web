<?php
class Database {

    public function __construct() {
    }
    
    public static function executeQuery($query, $converter) {
        $connection = Database::getConnectionDatabase();
        $resultSet = $connection->query($query);            
        $connection->close();

        return $converter.convert($resultSet);
    }

    private static function getConnectionDatabase() {
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $databaseName = "uniaservice"; 

        return new mysqli($hostname, $username, $password, $databaseName);
    }
}
?>