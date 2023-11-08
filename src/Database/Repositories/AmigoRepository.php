<?php

require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Converters/AmigoConverter.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/AbstractRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Dto/StatementParameter.php");

const SELECT_ALL_AMIGOS = "SELECT * FROM amigo";

const SELECT_BY_USER_EMAIL = "SELECT * FROM amigo WHERE email_user = ?";

const INSERT_SQL_AMIGO = "INSERT INTO amigo (email_user, email_amigo) VALUES (?, ?)";

const DELETE_BY_ID = "delete FROM amigo WHERE id = ?";

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

        parent::executeStatement(INSERT_SQL_AMIGO, $statementParameter);
    }

    /**
     * @return Array de AmigoEntity
     */
    public function findAll() {
        return parent::executeQueryList(SELECT_ALL_AMIGOS, new AmigoConverter());
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

        return parent::executeQueryStatemant(DELETE_BY_ID, $statementParameter, new AmigoConverter());

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

        return parent::executeQueryStatemant(SELECT_BY_USER_EMAIL, $statementParameter, new AmigoConverter());
    }

    public function update($entity) {
        // not implemented
    }

    public function findById($id) {
        // not implemented
    }

    public function existById($id) {
        // not implemented
    }

}