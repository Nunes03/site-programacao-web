<?php

require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/AmigoRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/AmigoEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Utils/Util.php");

function loadAmigos() {
    $amigoEntity = buildAmigoEntity();

    $amigoRepository = new AmigoRepository();
    return $amigoRepository->findByUserId(
        $amigoEntity->getIdUser(),
        $amigoEntity->getIdAmigo()
    );
}

function buildAmigoEntity() {
    $id_user = $POST["id_user"];
    $id_amigo = $POST["id_amigo"];

    $amigoEntity = new AmigoEntity();
    $amigoEntity->setIdUser($id_user);
    $amigoEntity->setIdAmigo($id_amigo);

    return $amigoEntity;
}

?>