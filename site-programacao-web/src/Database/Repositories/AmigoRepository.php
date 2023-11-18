<?php

require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Converters/AmigoConverter.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/AbstractRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Dto/StatementParameter.php");

const SELECT_ALL = `SELECT * FROM amigo`;

const SELECT_BY_USER_ID = `SEELCT * FROM amigo WHERE id_user = ?`;

define(
    "INSERT_SQL",
    `INSERT INTO amigo (id_user, id_amigo) VALUES (?, ?)`
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
            "create",
            array(
                $entity->getIdUser(),
                $entity->getIdAmigo()
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
            "delete",
            array($id)
        );

        return parent::executeQueryStatement(DELETE_BY_ID, $statementParameter);

    }

    /**
     * @param int $id_user
     * @return AmigoEntity $entity
     */
    public function findByUserId($id_user) {
        $statementParameter = new StatementParameter(
            "selectByUserId",
            array($id_user)
        );

        return parent::executeQueryStatement(SELECT_BY_USER_ID, $statementParameter);
    }

}

?>