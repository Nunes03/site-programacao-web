<?php

require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Converters/AmigoConverter.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/AbstractRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Dto/StatementParameter.php");

const SELECT_ALL_AMIGOS = "SELECT * FROM amigo";

const SELECT_BY_USER_EMAIL = "SELECT * FROM amigo WHERE amigo.email_user = ? or amigo.email_amigo = ?";

const INSERT_SQL_AMIGO = "INSERT INTO amigo (email_user, email_amigo) VALUES (?, ?)";

const DELETE_BY_EMAIL = "DELETE FROM amigo WHERE amigo.email_user = ? AND amigo.email_amigo = ? or amigo.email_amigo = ? AND amigo.email_user = ?";

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
     * @param string $email_user
     * @param string $email_amigo
     * @return void
     */
    public function deleteByUserEmailAndAmigoEmail($email_user, $email_amigo) {
        $statementParameter = new StatementParameter(
            "ssss",
            array(
                $email_user,
                $email_amigo,
                $email_user,
                $email_amigo
            )
        );
        parent::executeStatement(DELETE_BY_EMAIL, $statementParameter);
    }

    /**
     * @param string $user_email
     * @return array $AmigoEntity
     */
    public function findByUserEmail($user_email) {
        $statementParameter = new StatementParameter(
            "ss",
            array($user_email, $user_email)
        );
        return parent::executeQueryListStatemant(SELECT_BY_USER_EMAIL, $statementParameter, new AmigoConverter());
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

    public function deleteById($id) {
        // not implemented
    }
}