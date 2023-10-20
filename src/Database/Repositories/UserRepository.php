<?php
require __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Converters/UserConverter.php");
require __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/AbstractRepository.php");

class UserRepository extends AbstractRepository
{

    public static function save($entity)
    {   
        var_dump("Entidade: ");
        var_dump($entity);
        $sql = "insert into user (name, last_name, birthday, status, email, password) "
            . "values ('{nome}', '{lastName}', '{birthday}', '{status}', '{email}', '{password}')";

        $sql = str_replace(
            array("{nome}", "{lastName}", "{birthday}", "{status}", "{email}", "{password}"),
            array(
                $entity->getName(), $entity->getLastName(), $entity->getBirthday(),
                $entity->getStatus(), $entity->getEmail(), $entity->getPassword()
            ),
            $sql
        );
        
var_dump($sql);

        parent::execute($sql);
    }

    public static function findAll()
    {
        $sql = "select * from `user`";
        return parent::executeQueryList($sql, new UserConverter());
    }

    public static function findById($id)
    {
        $sql = str_replace(
            "{id}",
            $id,
            "select * from `user` where `user`.id = {id}"
        );

        return parent::executeQuery($sql, new UserConverter());
    }

    public static function deleteById($id)
    {
    }

    public static function existById($id)
    {
    }
}
