<?php

require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/AmigoRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/AmigoEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Dto/AmigoOutput.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Utils/Util.php");

$amigoOutput = loadAmigos();

echo json_encode($amigoOutput);

/**
 * @return AmigoEntity
 */
function loadAmigos(): AmigoEntity
{
    $email = $_POST["email"];
    var_dump($email.gettype());
    $amigoRepository = new AmigoRepository();
    return $amigoRepository->findByUserEmail(
        $email
    );
}