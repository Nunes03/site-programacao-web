<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/UserRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/UserEntity.php");

if (userExists()) {
    echo "Já existe um usuário cadastrado com esse email.";
} else {
    createUser();
    echo "Usuário criado com sucesso!";
}

function userExists() {
    $userRepository = new UserRepository();
    return $userRepository->existByEmail($_POST["email"]);
}

function createUser()
{
    $userEntity = new UserEntity();
    $userEntity->setName($_POST["name"]);
    $userEntity->setEmail($_POST["email"]);
    $userEntity->setPassword($_POST["password"]);

    $userRepository = new UserRepository();
    $userRepository->save($userEntity);
}