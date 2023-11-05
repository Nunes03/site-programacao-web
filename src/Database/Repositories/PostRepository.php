<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Converters/PostConverter.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/AbstractRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Dto/StatementParameter.php");

class PostRepository extends AbstractRepository
{

    /**
     * @param $entity PostEntity
     * @return void
     */
    public function create($entity)
    {
        // TODO: Implement create() method.
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

    public function deleteById($id)
    {
        // TODO: Implement deleteById() method.
    }

    public function existById($id)
    {
        // TODO: Implement existById() method.
    }
}
