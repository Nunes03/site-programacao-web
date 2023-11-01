<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/UserRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/UserEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Dto/PerfilOutput.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Utils/Util.php");

$perfilOutput = new PerfilOutput();
$profileInput = getUserPost();

changesUser();

echo json_encode($perfilOutput);

/**
 * @return void
 */
function changesUser()
{
    $userEntity = getUserPost();

    $userRepository = new UserRepository();
    $userRepository->update($userEntity);
}

/**
 * @return UserEntity
 */
function getUserPost()
{
    $userEntity = new UserEntity();
    $userEntity->setName($_POST["name"]);
    $userEntity->setLastName($_POST["lastName"]);
    $userEntity->setBirthday($_POST["birthday"]);
    $userEntity->setStatus($_POST["status"]);
    $photo = str_replace('data:image/png;base64,', '', $_POST["photo"]);
    $userEntity->setPhoto($photo);

    var_dump($userEntity);
    die();

    return $userEntity;
}
