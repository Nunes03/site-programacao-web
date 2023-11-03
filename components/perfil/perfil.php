<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/UserRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/UserEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Dto/PerfilOutput.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Utils/Util.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/UserFile/UserFileManagement.php");

$perfilOutput = changesUser();

echo json_encode($perfilOutput);

/**
 * @return PerfilOutput
 */
function changesUser()
{
    $userEntity = getUserPost();

    $userRepository = new UserRepository();
    $userRepository->update($userEntity);

    $perfilOutput = new PerfilOutput();
    $perfilOutput->name = $userEntity->getName();
    $perfilOutput->lastName = $userEntity->getLastName();
    $perfilOutput->birthday = $userEntity->getBirthday();
    $perfilOutput->status = $userEntity->getStatus();
    $perfilOutput->photoFileName = $userEntity->getPhotoFileName();

    return $perfilOutput;
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
    $userEntity->setEmail($_POST["email"]);

    $photoName = $_POST["photoFileName"];

    if ($photoName != null) {
        $userEntity->setPhotoFileName($photoName);
        $photoBlob = addslashes($_FILES["photoFileContent"]["tmp_name"]);
        $photoBlob = file_get_contents($photoBlob);

        UserFileManagement::saveProfileFile(
            $userEntity->getEmail(),
            $photoName,
            $photoBlob
        );
    }

    return $userEntity;
}
