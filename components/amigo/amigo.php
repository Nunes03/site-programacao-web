<?php

require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/AmigoRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/AmigoEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Dto/AmigoOutput.php");

$amigoOutput = loadAmigos();

echo json_encode($amigoOutput);

/**
 * @return array
 */
function loadAmigos()
{
    $email = $_POST["email"];
    $amigoRepository = new AmigoRepository();
    return $amigoRepository->findByUserEmail(
        $email
    );
}