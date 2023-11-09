<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Converters/UserConverter.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/AbstractRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Dto/StatementParameter.php");

const SELECT_ALL = "select * from user";

const SELECT_BY_ID = "select * from user where user.id = ?";

const SELECT_BY_EMAIL = "select * from user where user.email = ?";

const SELECT_ALL_BY_NAME = "select * from user where user.name like concat(?, '%')";

const SELECT_LIMIT_10_BY_NAME = "select * from user order by name limit 10";

const SELECT_BY_EMAIL_AND_PASSWORD = "select * from user where user.email = ? and user.password = ?";

const SELECT_RANDOM_USER = "SELECT * FROM user WHERE user.email NOT LIKE ? and 0 = (SELECT COUNT(*) from amigo where amigo.email_user like ? and amigo.email_amigo like user.email) ORDER BY RAND() LIMIT 1";

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
     * @param $email string
     * @return UserEntity|null
     */
    public function getRandomUser($email)
    {
        $statementParameter = new StatementParameter(
            "ss",
            array($email, $email)
        );

        return parent::executeQueryStatemant(SELECT_RANDOM_USER, $statementParameter, new UserConverter());
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

   /**
     * @param $name string
     * @return array
     */
    public function findAllByName($name)
    {
        $statementParameter = new StatementParameter(
            "s",
            array($name)
        );

        $resultSet = parent::executeQueryListStatemant(
            SELECT_ALL_BY_NAME,
            $statementParameter,
            new UserConverter()
        );
        return $resultSet;
    }

    public function findAllByLimit10()
    {
        return parent::executeQueryList(SELECT_LIMIT_10_BY_NAME, new UserConverter());
    }
}
