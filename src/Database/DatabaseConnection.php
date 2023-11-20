<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../Dto/DatabaseConnectionDto.php");

define(
    "CREATE_TABLES_FILE_PATH",
    __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/Sql/create_tables.sql")
);

define(
    "POPULATION_DATABASE_FILE_PATH",
    __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/Sql/population_database.sql")
);

const CHECKS_IF_THERE_IS_DATA_IN_THE_DATABASE = "select * from `user` where id > 0";

class DatabaseConnection
{

    /**
     * @param $sql string
     * @return bool|mysqli_result
     */
    public static function executeSql($sql)
    {
        self::createTables();
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
        self::createTables();
        self::populationDatabase();
        $connection = self::getConnectionDatabase();
        return self::executeSqlNotValidationStatement($connection, $sql, $statementParameter);
    }

    private static function createTables()
    {
        $fileContent = file_get_contents(CREATE_TABLES_FILE_PATH);
        $createdatabaseSql = explode(";", $fileContent);

        foreach ($createdatabaseSql as $sql) {
            $connection = self::getConnectionDatabase();
            self::executeSqlNotValidation($connection, $sql);
        }
    }

    private static function populationDatabase()
    {
        $connection = self::getConnectionDatabase();
        $resultSet = self::executeSqlNotValidation($connection, CHECKS_IF_THERE_IS_DATA_IN_THE_DATABASE);

        $row = mysqli_fetch_array($resultSet);
        if ($row["id"] == null) {
            $fileContent = file_get_contents(POPULATION_DATABASE_FILE_PATH);
            $populationDatabaseSql = explode(";", $fileContent);

            foreach ($populationDatabaseSql as $sql) {
                $connection = self::getConnectionDatabase();
                self::executeSqlNotValidation($connection, $sql);
            }
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

        call_user_func_array("mysqli_stmt_bind_param", $bindParams);

        $statement->execute();
        $resultSet = $statement->get_result();

        mysqli_stmt_close($statement);
        mysqli_close($connection);

        return $resultSet;
    }

    /**
     * @return false|mysqli
     */
    private static function getConnectionDatabase()
    {
        $databaseConnectionDto = self::isDevelopment()
            ? self::getDevelopmentConnection()
            : self::getProductionConnection();

        return mysqli_connect(
            $databaseConnectionDto->hostname,
            $databaseConnectionDto->username,
            $databaseConnectionDto->password,
            $databaseConnectionDto->databaseName
        );
    }

    /**
     * @return DatabaseConnectionDto
     */
    private static function getDevelopmentConnection()
    {
        return new DatabaseConnectionDto(
            "localhost",
            "root",
            "",
            "uniaservice"
        );
    }

    /**
     * @return DatabaseConnectionDto
     */
    private static function getProductionConnection()
    {
        return new DatabaseConnectionDto(
            "localhost",
            "id21544124_root",
            "senhaSite1.",
            "id21544124_uniaservice"
        );
    }

    /**
     * @return bool
     */
    public static function isDevelopment()
    {
        return true;
    }

    /**
     * @return string
     */
    public static function isDevelopmentFront()
    {
        return self::isDevelopment()
            ? "true"
            : "false";
    }
}
