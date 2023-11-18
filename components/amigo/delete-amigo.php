<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/AmigoRepository.php");

deleteAmigo();

function deleteAmigo() {
    $amigoRepository = new AmigoRepository();
    $amigoRepository->deleteByUserEmailAndAmigoEmail($_POST["userEmail"], $_POST["amigoEmail"]);
}