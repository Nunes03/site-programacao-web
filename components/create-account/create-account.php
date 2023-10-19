<?php
require "../../src/Database/Repositories/UserRepository.php";

$repository = new UserRepository();
$repository->findAll();
?>