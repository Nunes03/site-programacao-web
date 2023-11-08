<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/UserRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/UserEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Dto/LoginOutput.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Utils/Util.php");

$listaUsersOutput = array();

$users =  getUsersByName();

foreach ($users as $key => $user) {
    $listaUsersOutput += [$key => $users[$key]];
    // array_push($listaUsersOutput, $key => $users[$key]);
}

echo json_encode($listaUsersOutput);

function getUsersByName()
{
    $userEntity = builToUserEntity();

    $userRepository = new UserRepository();
    return $userRepository->findAllByName(
        $userEntity->getName()
    );
}

function builToUserEntity()
{
    $name = $_POST["name"];

    $userEntity = new UserEntity();
    $userEntity->setName($name);

    return $userEntity;
}

