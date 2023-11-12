<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/UserEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/PostEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/PostRepository.php");


echo json_encode(getPostsByEmailUser());

function getPostsByEmailUser() {
    $posts = array();

    date_default_timezone_set('America/Sao_Paulo');
    $date = date("d/m/y H:i");

    $userOne = new UserEntity();
    $userOne->setName("Lucas");
    $userOne->setLastName("Nunes");
    $userOne->setEmail("lucas@email.com");
    $userOne->setPhotoFileName("processo_utilizacao_lib.png");

    $userTwo = new UserEntity();
    $userTwo->setName("Pedro");
    $userTwo->setLastName("Souza");
    $userTwo->setEmail("lucas@email.com");
    $userTwo->setPhotoFileName("processo_utilizacao_lib.png");

    $postOne = new PostEntity();
    $postOne->setContent("Olá mundo");
    $postOne->setDate($date);
    $postOne->setLikes(5);
    $postOne->setFileName("cachorro.png");
    $postOne->setUser($userOne);

    $postTwo = new PostEntity();
    $postTwo->setContent("Olá mundo 2");
    $postTwo->setDate($date);
    $postTwo->setLikes(10);
    $postTwo->setFileName("cachorro.png");
    $postTwo->setUser($userTwo);

    $posts[] = $postOne->toDto();
    $posts[] = $postTwo->toDto();

    return $posts;
}
