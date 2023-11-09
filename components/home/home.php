<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/UserRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/UserEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Dto/LoginOutput.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Utils/Util.php");

$listaUsersOutput = array();

if($_POST["name"])
$users =  getUsersByName();
else
$users =  getUsersLimit10();

foreach ($users as $user) {
    $listaUsersOutput[] = $user->toDto();
} 

echo json_encode($listaUsersOutput);

function getUsersLimit10()
{
    $userRepository = new UserRepository();
    return $userRepository->findAllByLimit10();
}

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

