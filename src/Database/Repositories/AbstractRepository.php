<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../DatabaseConnection.php");

abstract class AbstractRepository
{

    abstract public function create($entity);

    abstract public function update($entity);

    abstract public function findAll();

    abstract public function findById($id);

    abstract public function deleteById($id);

    abstract public function existById($id);

    public static function executeQuery($query, $converter)
    {
        $contents = self::executeQueryList($query, $converter);

        if (empty($contents)) {
            return null;
        }

        return $contents[0];
    }

    public static function executeQueryList($query, $converter)
    {
        $resultSet = DatabaseConnection::executeSql($query);
        return $converter->convert($resultSet);
    }

    public static function execute($query)
    {
        DatabaseConnection::executeSql($query);
    }
}
