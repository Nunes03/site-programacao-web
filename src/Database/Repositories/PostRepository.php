<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Converters/PostConverter.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/AbstractRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/UserRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Dto/StatementParameter.php");

define (
    "INSERT_POST_SQL",
    "insert into uniaservice.post " .
    "(content, date, likes, file_name, user_id) " .
    "values " .
    "(?, ?, ?, ?, ?) "
);

define(
    "SELECT_RELATED_BY_USER_EMAIL",
    "select "
    . "distinct post.* "
    . "from "
    . "uniaservice.post post "
    . "inner join uniaservice.`user` `user` on "
    . "post.user_id = `user`.id "
    . "left join uniaservice.amigo amigo on "
    . "(`user`.id = amigo.id_user "
    . "or `user`.id = amigo.id_amigo) "
    . "where "
    . "`user`.id = ? "
    . "or amigo.id_amigo = ? "
    . "or amigo.id_user = ? "
    . "order by post.date desc"
);

class PostRepository extends AbstractRepository
{

    /**
     * @param $entity PostEntity
     * @return void
     */
    public function create($entity)
    {
        $statementParameter = new StatementParameter(
            "ssisi",
            array(
                $entity->getContent(),
                $entity->getDate(),
                $entity->getLikes(),
                $entity->getFileName(),
                $entity->getUser()->getId(),
            )
        );

        parent::executeStatement(INSERT_POST_SQL, $statementParameter);
    }

    /**
     * @param $entity PostEntity
     * @return void
     */
    public function update($entity)
    {
        // TODO: Implement update() method.
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
    }

    public function findById($id)
    {
        // TODO: Implement findById() method.
    }

    /**
     * @param $email string
     * @return array
     */
    public function findAllRelatedByUserEmail($email)
    {
        $userRepository = new UserRepository();
        $user = $userRepository->findByEmail($email);

        $statementParameter = new StatementParameter(
            "iii",
            array(
                $user->getId(),
                $user->getId(),
                $user->getId()
            )
        );

        $resultSet = parent::executeQueryListStatemant(
            SELECT_RELATED_BY_USER_EMAIL,
            $statementParameter,
            new PostConverter()
        );

        foreach ($resultSet as $post) {
            $userId = $post->getUser()->getId();
            $userFound = $userRepository->findById($userId);
            $post->setUser($userFound);
        }

        return $resultSet;
    }

    public function deleteById($id)
    {
        // TODO: Implement deleteById() method.
    }

    public function existById($id)
    {
        // TODO: Implement existById() method.
    }
}
