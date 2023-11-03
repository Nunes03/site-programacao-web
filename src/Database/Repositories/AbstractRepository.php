<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../DatabaseConnection.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Converters/UserConverter.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Dto/StatementParameter.php");

abstract class AbstractRepository
{

    abstract public function create($entity);

    abstract public function update($entity);

    abstract public function findAll();

    abstract public function findById($id);

    abstract public function deleteById($id);

    abstract public function existById($id);

    /**
     * @param $sql string
     * @param $converter ConverterInterface
     * @return mixed|null
     */
    public static function executeQuery($sql, $converter)
    {
        $contents = self::executeQueryList($sql, $converter);

        if (empty($contents)) {
            return null;
        }

        return $contents[0];
    }

    /**
     * @param $sql string
     * @param $statementParameter StatementParameter
     * @param $converter ConverterInterface
     * @return mixed|null
     */
    public static function executeQueryStatemant($sql, $statementParameter, $converter)
    {
        $contents = self::executeQueryListStatemant($sql, $statementParameter, $converter);

        if (empty($contents)) {
            return null;
        }

        return $contents[0];
    }

    /**
     * @param $sql string
     * @param $converter ConverterInterface
     * @return array
     */
    public static function executeQueryList($sql, $converter)
    {
        $resultSet = DatabaseConnection::executeSql($sql);
        return $converter->convert($resultSet);
    }

    /**
     * @param $sql string
     * @param $statementParameter StatementParameter
     * @param $converter ConverterInterface
     * @return array
     */
    public static function executeQueryListStatemant($sql, $statementParameter, $converter)
    {
        $resultSet = DatabaseConnection::executeSqlStatement($sql, $statementParameter);
        return $converter->convert($resultSet);
    }

    /**
     * @param $sql string
     * @return void
     */
    public static function execute($sql)
    {
        DatabaseConnection::executeSql($sql);
    }

    /**
     * @param $sql string
     * @param $statementParameter StatementParameter
     * @return void
     */
    public static function executeStatement($sql, $statementParameter)
    {
        DatabaseConnection::executeSqlStatement($sql, $statementParameter);
    }
}
