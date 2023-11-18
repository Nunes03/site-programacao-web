<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/UserRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/AmigoRepository.php");

$parameters = $_POST["methodParameters"];

switch ($_POST["methodName"]) {
    case "findUserByEmail":
        echo json_encode(findUserByEmail($parameters));
        break;
    case "findAmigosByUserEmail":
        echo json_encode(findAmigosByUserEmail($parameters));
        break;
    case "getRandomUser":
        echo json_encode(getRandomUser($parameters));
        break;
    default:
        echo "{}";
}

/**
 * @param $email string
 * @return UserDto
 */
function findUserByEmail($email)
{
    $userRepository = new UserRepository();
    $userEntity = $userRepository->findByEmail($email);
    return $userEntity->toDto();
}

/**
 * @param $email string
 * @return array de AmigoDto
 */
function findAmigosByUserEmail($email) {
    $amigoRepository = new AmigoRepository();
    $amigoEntities = $amigoRepository->findByUserEmail($email);

    $amigoDtoList = array();
    foreach ($amigoEntities as $amigoEntity) {
        $amigoDtoList[] = $amigoEntity->toDto();
    }
    return $amigoDtoList;
}

function getRandomUser($email) {
    $userRepository = new UserRepository();
    $userEntity = $userRepository->getRandomUser($email);
    return $userEntity->toDto();
}
