<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/UserRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/UserEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Dto/CreateAccountOutput.php");

$createAccountOutput = new CreateAccountOutput();

if (userExists()) {
    $createAccountOutput->message = "Já existe um usuário cadastrado com esse email.";
} else {
    createUser();
    $createAccountOutput->message = "Usuário criado com sucesso!";
}

echo json_encode($createAccountOutput);

/**
 * @return UserEntity
 */
function getUserPost()
{
    $userEntity = new UserEntity();
    $userEntity->setName($_POST['name']);
    $userEntity->setEmail($_POST['email']);
    $userEntity->setPassword($_POST['password']);

    return $userEntity;
}

/**
 * @return bool
 */
function userExists()
{
    $userEntity = getUserPost();

    $userRepository = new UserRepository();
    return $userRepository->existByEmail($userEntity->getEmail());
}

/**
 * @return void
 */
function createUser()
{
    $userPost = getUserPost();

    $userEntity = new UserEntity();
    $userEntity->setName($userPost->getName());
    $userEntity->setEmail($userPost->getEmail());
    $userEntity->setPassword($userPost->getPassword());

    $userRepository = new UserRepository();
    $userRepository->create($userEntity);
}
