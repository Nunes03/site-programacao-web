<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Converters/UserConverter.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/AbstractRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Dto/StatementParameter.php");

const SELECT_ALL = "select * from user";

const SELECT_BY_ID = "select * from user where user.id = ?";

const SELECT_BY_EMAIL = "select * from user where user.email = ?";

const SELECT_BY_EMAIL_AND_PASSWORD = "select * from user where user.email = ? and user.password = ?";

define(
    "INSERT_SQL",
    "insert into user "
    . "(name, email, password) "
    . "values "
    . "(?, ?, ?)"
);

define(
    "UPDATE_BY_EMAIL_SQL",
    "update user "
    . "set "
    . "name = ?, "
    . "last_name = ?, "
    . "birthday = ?, "
    . "status = ?, "
    . "photo_file_name = ? "
    . "where email = ?"
);

class UserRepository extends AbstractRepository
{

    /**
     * @param $entity UserEntity
     * @return void
     */
    public function create($entity)
    {
        $statementParameter = new StatementParameter(
            "sss",
            array(
                $entity->getName(),
                $entity->getEmail(),
                $entity->getPassword()
            )
        );

        parent::executeStatement(INSERT_SQL, $statementParameter);
    }

    /**
     * @param $entity UserEntity
     * @return void
     */
    public function update($entity)
    {
        $statementParameter = new StatementParameter(
            "ssssss",
            array(
                $entity->getName(),
                $entity->getLastName(),
                $entity->getBirthday(),
                $entity->getStatus(),
                $entity->getPhotoFileName(),
                $entity->getEmail()
            )
        );

        parent::executeStatement(UPDATE_BY_EMAIL_SQL, $statementParameter);
    }

    public function findAll()
    {
        return parent::executeQueryList(SELECT_ALL, new UserConverter());
    }

    /**
     * @param $id int
     * @return mixed|null
     */
    public function findById($id)
    {
        $statementParameter = new StatementParameter(
            "i",
            array($id)
        );

        return parent::executeQueryStatemant(SELECT_BY_ID, $statementParameter, new UserConverter());
    }

    /**
     * @param $email string
     * @return UserEntity|null
     */
    public function findByEmail($email)
    {
        $statementParameter = new StatementParameter(
            "s",
            array($email)
        );

        return parent::executeQueryStatemant(SELECT_BY_EMAIL, $statementParameter, new UserConverter());
    }

    /**
     * @param $id int
     * @return null
     */
    public function deleteById($id)
    {
        return null;
    }

    /**
     * @param $id int
     * @return null
     */
    public function existById($id)
    {
        return null;
    }

    /**
     * @param $email string
     * @return bool
     */
    public function existByEmail($email)
    {
        $resultSet = self::findByEmail($email);
        return $resultSet != null;
    }

    /**
     * @param $email string
     * @param $password string
     * @return bool
     */
    public function existByEmailAndPassword($email, $password)
    {
        $statementParameter = new StatementParameter(
            "ss",
            array($email, $password)
        );

        $resultSet = parent::executeQueryStatemant(
            SELECT_BY_EMAIL_AND_PASSWORD,
            $statementParameter,
            new UserConverter()
        );

        return $resultSet != null;
    }
}
