<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../DatabaseConnection.php");

abstract class AbstractRepository
{

    static abstract function save($entity);

    static abstract function findAll();

    static abstract function findById($id);

    static abstract function deleteById($id);

    static abstract function existById($id);

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
        $resultSet = DatabaseConnection::executeQuery($query);
        return $converter->convert($resultSet);
    }

    public static function execute($query) {
        DatabaseConnection::executeQuery($query);
    }
}
