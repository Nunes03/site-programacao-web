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
    if ($_FILES["photo"] != null) {
        $photoBlob = file_get_contents($_FILES["photo"]["tmp_name"]);
        $userEntity->setPhoto($photoBlob);
    }

    return $userEntity;
}
