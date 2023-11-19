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
function findAmigosByUserEmail($email_user) {
    $amigoRepository = new AmigoRepository();
    $amigoEntities = $amigoRepository->findByUserEmail($email_user);

    $amigoDtoList = array();
    //  Caso o outro usuario adicione o atual usuario como amigo
    //  esse if irá fazer a troca para que o resultado de email_user
    //  seja igual ao email do usuario atual
    foreach ($amigoEntities as $amigoEntity) {
        if ($amigoEntity->getAmigoEmail() == $email_user) {
            $amigoEntity->setAmigoEmail($amigoEntity->getUserEmail());
            $amigoEntity->setUserEmail($email_user);
        }
        $amigoDtoList[] = $amigoEntity->toDto();
    }

    return $amigoDtoList;
}

function getRandomUser($email) {
    $userRepository = new UserRepository();
    $userEntity = $userRepository->getRandomUser($email);
    return $userEntity->toDto();
}
