<?php

require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Converters/AmigoConverter.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/AbstractRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Dto/StatementParameter.php");

const SELECT_ALL = `SELECT * FROM amigo`;

const SELECT_BY_USER_EMAIL = `SEELCT * FROM amigo WHERE email_user = ?`;

define(
    "INSERT_SQL",
    `INSERT INTO amigo (email_user, email_amigo) VALUES (?, ?)`
);

define(
    "DELETE_BY_ID",
    `DELETE FROM amigo WHERE id = ?`
);

class AmigoRepository extends AbstractRepository {

    /**
     * @param AmigoEntity $entity
     * @return void
     */
    public function create($entity) {
        $statementParameter = new StatementParameter(
            "ss",
            array(
                $entity->getUserEmail(),
                $entity->getAmigoEmail()
            )
        );

        parent::executeStatement(INSERT_SQL, $statementParameter);
    }

    /**
     * @return Array de AmigoEntity
     */
    public function findAll() {
        return parent::executeQueryList(SELECT_ALL, new AmigoConverter());
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteById($id) {
        $statementParameter = new StatementParameter(
            "i",
            array($id)
        );

        return parent::executeQueryStatement(DELETE_BY_ID, $statementParameter);

    }

    /**
     * @param string $user_email
     * @return AmigoEntity $entity
     */
    public function findByUserEmail($user_email) {
        $statementParameter = new StatementParameter(
            "s",
            array($user_email)
        );

        return parent::executeQueryStatement(SELECT_BY_USER_EMAIL, $statementParameter);
    }

}

?>