<?php
require "src/Database/DatabaseConnection.php";

require "src/Converters/UserConverter.php";

class UserRepository
{
    public function __construct()
    {
    }

    public function findAll()
    {
        $converter = new UserConverter();

        $databaseConnection = new DatabaseConnection();
        return $databaseConnection->executeQuery("select * from user;", $converter);
    }
}
?>
