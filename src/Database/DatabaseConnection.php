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

    /**
     * @param $sql string
     * @param $statemantParameters array
     * @return bool|mysqli_result
     */
    public static function executeSql($sql, $statemantParameters)
    {
        self::createDatabase();
        $connection = self::getConnectionDatabase();
        return self::executeSqlNotValidation($connection, $sql, $statemantParameters);
    }

    private static function createDatabase()
    {
        $fileContent = file_get_contents(CREATE_DATABASE_FILE_PATH);
        $createdatabaseSql = explode(";", $fileContent);

        foreach ($createdatabaseSql as $sql) {
            $connection = self::getConnectionServer();
            self::executeSqlNotValidation($sql, $connection, array());
        }
    }

    /**
     * @param $connection mysqli
     * @param $sql string
     * @param $statemantParameters array
     * @return bool|mysqli_result
     */
    private static function executeSqlNotValidation($connection, $sql, $statemantParameters)
    {
        $statement = $connection->prepare($sql);

        foreach ($statemantParameters as $parameter) {
            $statement->bind_param($parameter->name, $parameter->value);
        }

        $resultSet = $statement->get_result();
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
