<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/UserEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/PostEntity.php");

echo json_encode(test());

function test() {
    $posts = array();

    $date = date("d/m/y");

    $user = new UserEntity();
    $user->setName("Lucas");
    $user->setLastName("Nunes");
    $user->setPhotoFileName("cabeloXi.png");

    $postOne = new PostEntity();
    $postOne->setContent("Olá mundo");
    $postOne->setDate($date);
    $postOne->setLikes(5);
    $postOne->setFileName("cachorro.png");
    $postOne->setUser($user);

    $postTwo = new PostEntity();
    $postTwo->setContent("Olá mundo 2");
    $postTwo->setDate($date);
    $postTwo->setLikes(10);
    $postTwo->setFileName("cachorro.png");
    $postTwo->setUser($user);

    $posts[] = $postOne->toDto();
    $posts[] = $postTwo->toDto();

    return $posts;
}
