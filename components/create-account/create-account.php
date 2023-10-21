<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/UserRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/UserEntity.php");

header("Content-Type: text/html; charset=utf-8");

$response = "";

if (userExists()) {
    $response = "Já existe um usuário cadastrado com esse email.";
} else {
    createUser();
    $response = "Usuário criado com sucesso!";
}

function userExists()
{
    $userRepository = new UserRepository();
    return $userRepository->existByEmail($_GET["email"]);
}

function createUser()
{
    $userEntity = new UserEntity();
    $userEntity->setName($_GET["name"]);
    $userEntity->setEmail($_GET["email"]);
    $userEntity->setPassword($_GET["password"]);

    $userRepository = new UserRepository();
    $userRepository->save($userEntity);
}

echo utf8_encode($response);