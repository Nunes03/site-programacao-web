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
     * @return bool|mysqli_result
     */
    public static function executeSql($sql)
    {
        self::createDatabase();
        $connection = self::getConnectionDatabase();
        return self::executeSqlNotValidation($connection, $sql);
    }

    /**
     * @param $sql string
     * @param $statementParameter StatementParameter
     * @return bool|mysqli_result
     */
    public static function executeSqlStatement($sql, $statementParameter)
    {
        self::createDatabase();
        $connection = self::getConnectionDatabase();
        return self::executeSqlNotValidationStatement($connection, $sql, $statementParameter);
    }

    private static function createDatabase()
    {
        $fileContent = file_get_contents(CREATE_DATABASE_FILE_PATH);
        $createdatabaseSql = explode(";", $fileContent);

        foreach ($createdatabaseSql as $sql) {
            $connection = self::getConnectionServer();
            self::executeSqlNotValidation($connection, $sql);
        }
    }

    /**
     * @param $connection mysqli
     * @param $sql string
     * @return bool|mysqli_result
     */
    private static function executeSqlNotValidation($connection, $sql)
    {
        $resultSet = null;

        if (!empty($sql)) {
            $resultSet = mysqli_query($connection, $sql);
            mysqli_close($connection);
        }

        return $resultSet;
    }

    /**
     * @param $connection mysqli
     * @param $sql string
     * @param $statementParameter StatementParameter
     * @return bool|mysqli_result
     */
    private static function executeSqlNotValidationStatement($connection, $sql, $statementParameter)
    {
        $statement = $connection->prepare($sql);

        $bindParams = array();
        $bindParams[] = &$statement;
        $bindParams[] = &$statementParameter->types;

        foreach ($statementParameter->values as $key => $value) {
            $bindParams[] = &$statementParameter->values[$key];
        }

        call_user_func_array('mysqli_stmt_bind_param', $bindParams);

        $statement->execute();
        $resultSet = $statement->get_result();

        mysqli_stmt_close($statement);
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
