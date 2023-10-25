<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/UserRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/UserEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Dto/CreateAccountOutput.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Utils/Util.php");

header("Content-Type: text/html; charset=utf-8");

$createAccountOutput = new CreateAccountOutput();

if (userExists()) {
    $createAccountOutput->message = utf8_encode("J� existe um usu�rio cadastrado com esse email.");
} else {
    createUser();
    $createAccountOutput->message = utf8_encode("Usu�rio criado com sucesso!");
}

function convertBase64ToObject() {
    $data = $_GET["data"];
    return Util::base64ToObject($data);
}

function userExists()
{
    $createAccountInput = convertBase64ToObject();
    $userRepository = new UserRepository();
    return $userRepository->existByEmail($createAccountInput->email);
}

function createUser()
{
    $createAccountInput = convertBase64ToObject();

    $userEntity = new UserEntity();
    $userEntity->setName($createAccountInput->name);
    $userEntity->setEmail($createAccountInput->email);
    $userEntity->setPassword($createAccountInput->password);

    $userRepository = new UserRepository();
    $userRepository->create($userEntity);
}

$json = json_encode($createAccountOutput);
echo Util::objectToBase64($createAccountOutput);
