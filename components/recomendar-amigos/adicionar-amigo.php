<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/AmigoEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/AmigoRepository.php");

addAmigo();

function addAmigo() {
    $amigoEntity = new AmigoEntity();
    $amigoEntity->setUserEmail($_POST["userEmail"]);
    $amigoEntity->setAmigoEmail($_POST["amigoEmail"]);
    $amigoRepository = new AmigoRepository();
    $amigoRepository->create($amigoEntity);
}