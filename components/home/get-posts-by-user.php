<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/UserEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/PostEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/PostRepository.php");

echo json_encode(getPostsByEmailUser());

function getPostsByEmailUser()
{
    $posts = array();
    $postRepository = new PostRepository();
    $postsEntities = $postRepository->findAllRelatedByUserEmail($_POST["email"]);

    foreach ($postsEntities as $postsEntity) {
        $dateTimestamp = strtotime($postsEntity->getDate());
        $postsEntity->setDate(date("d/m/Y H:i", $dateTimestamp));
        $posts[] = $postsEntity->toDto();
    }

    return $posts;
}
