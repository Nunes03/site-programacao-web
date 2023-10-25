<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/UserRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/UserEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Dto/PerfilOutput.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Utils/Util.php");

header("Content-Type: text/html; charset=utf-8");

$perfilOutput = new PerfilOutput();
$profileInput = convertBase64ToObject();

if ($profileInput->action == "get") {
    $perfilOutput = toOutput();
} else {
    changesUser();
}

function convertBase64ToObject() {
    $data = $_GET["data"];
    return Util::base64ToObject($data);
}

function getUser()
{
    $createAccountInput = convertBase64ToObject();
    $userRepository = new UserRepository();
    return $userRepository->findById($createAccountInput->idUser);
}

function toOutput()
{
    $user = getUser();
    $perfilOutput = new PerfilOutput();

    $perfilOutput->name = $user->getName();
    $perfilOutput->lastName = $user->getLastName();
    $perfilOutput->birthday = $user->getBirthday();
    $perfilOutput->status = $user->getStatus();

    return $perfilOutput;
}

function changesUser()
{
    $createAccountInput = convertBase64ToObject();

    $userEntity = new UserEntity();
    $userEntity->setName($createAccountInput->name);
    $userEntity->setLastName($createAccountInput->lastName);
    $userEntity->setBirthday($createAccountInput->birthday);
    $userEntity->setStatus($createAccountInput->status);

    $userRepository = new UserRepository();
    $userRepository->update($userEntity);
}

$json = json_encode($perfilOutput);
echo Util::objectToBase64($perfilOutput);
