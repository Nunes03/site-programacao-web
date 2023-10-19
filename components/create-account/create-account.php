<?php
require __DIR__.str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/UserRepository.php");

$repository = new UserRepository();
$repository->findAll();
?>