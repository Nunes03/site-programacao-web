<?php

define(
    "CREATE_DATABASE_FILE_PATH",
    __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/Sql/create_database.sql")
);

const HOSTNAME = "localhost";

const USERNAME = "root";

const PASSWORD = "";

const DATABASE_NAME = "uniaservice";

class DatabaseConnection
{

    public static function executeSql($query)
    {
        self::createDatabase();
        $connection = self::getConnectionDatabase();
        return self::executeSqlNotValidation($query, $connection);
    }

    private static function createDatabase()
    {
        $fileContent = file_get_contents(CREATE_DATABASE_FILE_PATH);
        $createdatabaseSql = explode(";", $fileContent);

        foreach ($createdatabaseSql as $sql) {
            $connection = self::getConnectionServer();
            self::executeSqlNotValidation($sql, $connection);
        }
    }

    private static function executeSqlNotValidation($sql, $connection)
    {
        $resultSet = mysqli_query($connection, $sql);
        mysqli_close($connection);

        return $resultSet;
    }

    private static function getConnectionServer()
    {
        return mysqli_connect(HOSTNAME, USERNAME, PASSWORD);
    }

    private static function getConnectionDatabase()
    {
        return mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE_NAME);
    }
}
