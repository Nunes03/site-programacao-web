<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/UserRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/UserEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Dto/LoginOutput.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Utils/Util.php");

$loginOutput = new LoginOutput();

if (userExists()) {
    $loginOutput->userExists = true;
} else {
    $loginOutput->userExists = false;
    $loginOutput->message = "Email ou senha incorretos!";
}

echo json_encode($loginOutput);

function userExists()
{
    $userEntity = builToUserEntity();

    $userRepository = new UserRepository();
    return $userRepository->existByEmailAndPassword(
        $userEntity->getEmail(),
        $userEntity->getPassword()
    );
}

function builToUserEntity()
{
    $email = $_POST["email"];
    $password = $_POST["password"];

    $userEntity = new UserEntity();
    $userEntity->setEmail($email);
    $userEntity->setPassword($password);

    return $userEntity;
}
