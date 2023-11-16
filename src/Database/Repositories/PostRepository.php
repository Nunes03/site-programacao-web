<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Converters/PostConverter.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/AbstractRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/UserRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Dto/StatementParameter.php");

const SELECT_BY_ID_POST_SQL = "select * from uniaservice.post post where post.id = ?";

define (
    "INSERT_POST_SQL",
    "insert into uniaservice.post " .
    "(content, date, likes, file_name, user_id) " .
    "values " .
    "(?, ?, ?, ?, ?) "
);

define (
    "UPDATE_LIKE_POST_BY_ID_SQL",
    "update uniaservice.post "
    . "set "
    . "likes = ? "
    . "where "
    . "id = ?"
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

define(
    "SELECT_RELATED_BY_EMAIL_SELECTED",
    "select "
    . "distinct post.* "
    . "from "
    . "uniaservice.post post "
    . "inner join uniaservice.`user` `user` on "
    . "post.user_id = `user`.id "
    . "where "
    . "`user`.email = ? "
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

    /**
     * @param $id int
     * @return void
     */
    public function addLikesById($id) {
        $postEntity = $this->findById($id);
        $likes = $postEntity->getLikes() + 1;

        $statementParameter = new StatementParameter(
            "ii",
            array(
                $likes,
                $id
            )
        );

        parent::executeStatement(
            UPDATE_LIKE_POST_BY_ID_SQL,
            $statementParameter
        );
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @param $id
     * @return mixed|null|PostEntity
     */
    public function findById($id)
    {
        $statementParameter = new StatementParameter(
            "i",
            array($id)
        );

        return parent::executeQueryStatemant(
            SELECT_BY_ID_POST_SQL,
            $statementParameter,
            new PostConverter()
        );
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

    /**
     * @param $email string
     * @returnarray
     */
    public function findByEmailSelected($email)
    {


        $statementParameter = new StatementParameter(
            "i",
            array($email)
        );
        // var_dump($statementParameter);


        $resultSet = parent::executeQueryListStatemant(
            SELECT_RELATED_BY_EMAIL_SELECTED,
            $statementParameter,
            new PostConverter()
        );



        $userRepository = new UserRepository();

        foreach ($resultSet as $post) {
            $userId = $post->getUser()->getId();
            $userFound = $userRepository->findById($userId);
            $post->setUser($userFound);
        }

        return $resultSet;
    }
}
