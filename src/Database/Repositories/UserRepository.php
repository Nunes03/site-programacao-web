<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Converters/UserConverter.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/AbstractRepository.php");

const SELECT_ALL = "select * from user";

const SELECT_BY_ID = "select * from user where user.id = {id}";

const SELECT_BY_EMAIL = "select * from user where user.email = '{email}'";

const SELECT_BY_EMAIL_AND_PASSWORD = "select * from user where user.email = '{email}' and user.password = '{password}'";

define(
    "INSERT_SQL",
    "insert into user "
        . "(name, last_name, birthday, status, email, password) "
        . "values "
        . "('{nome}', '{lastName}', '{birthday}', '{status}', '{email}', '{password}')"
);

define(
    "UPDATE_BY_EMAIL_SQL",
    "update user "
        . "set "
        . "name = '{name}', "
        . "last_name = '{lastName}', "
        . "birthday = '{birthday}', "
        . "status = '{status}', "
        . "email = '{email}', "
        . "password = '{password}' "
        . "where email = '{email}'"
);

class UserRepository extends AbstractRepository
{

    public function create($entity)
    {
        $sql = str_replace(
            array("{nome}", "{lastName}", "{birthday}", "{status}", "{email}", "{password}"),
            array(
                $entity->getName(), $entity->getLastName(), $entity->getBirthday(),
                $entity->getStatus(), $entity->getEmail(), $entity->getPassword()
            ),
            INSERT_SQL
        );

        parent::execute($sql);
    }

    /**
     * @param $entity UserEntity
     * @return void
     */
    public function update($entity)
    {
        $sql = str_replace(
            array("{name}", "{lastName}", "{birthday}", "{status}", "{email}"),
            array(
                $entity->getName(), $entity->getLastName(), $entity->getBirthday(),
                $entity->getStatus(), $entity->getEmail()
            ),
            UPDATE_BY_EMAIL_SQL
        );

        parent::execute($sql);
    }

    public function findAll()
    {
        return parent::executeQueryList(SELECT_ALL, new UserConverter());
    }

    public function findById($id)
    {
        $sql = str_replace(
            "{id}",
            $id,
            SELECT_BY_ID
        );

        return parent::executeQuery($sql, new UserConverter());
    }

    /**
     * @param $email string
     * @return UserEntity|null
     */
    public function findByEmail($email)
    {
        $sql = str_replace(
            "{email}",
            $email,
            SELECT_BY_EMAIL
        );

        return parent::executeQuery($sql, new UserConverter());
    }

    public function deleteById($id)
    {
        return null;
    }

    public function existById($id)
    {
        return null;
    }

    public function existByEmail($email)
    {
        $resultSet = self::findByEmail($email);
        return $resultSet != null;
    }

    public function existByEmailAndPassword($email, $password)
    {
        $sql = str_replace(
            array("{email}", "{password}"),
            array($email, $password),
            SELECT_BY_EMAIL_AND_PASSWORD
        );
        
        $resultSet = parent::executeQuery($sql, new UserConverter());
        return $resultSet != null;
    }
}
