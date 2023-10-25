<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/UserRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Dto/LoginOutput.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Utils/Util.php");

$loginOutput = new LoginOutput();

if (userExists()) {
    $loginOutput->userExists = true;
} else {
    $loginOutput->userExists = false;
    $loginOutput->message = utf8_encode("Email ou senha incorretos!");
}

$json = json_encode($loginOutput);
echo Util::objectToBase64($loginOutput);

function userExists() {
    $user = convertBase64ToObject();

    $userRepository = new UserRepository();
    return $userRepository->existByEmailAndPassword(
        $user->email,
        $user->password
    );
}

function convertBase64ToObject() {
    $data = $_GET["data"];
    return Util::base64ToObject($data);
}
