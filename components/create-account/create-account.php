<?php
require_once __DIR__.str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/UserRepository.php");
require_once __DIR__.str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/UserEntity.php");

// $data = '26/11/2017';
// $data = date('d/m/Y', strtotime($data));

// $user = new UserEntity();
// $user->setName("Lucas");
// $user->setLastName("Nunes");
// $user->setBirthday($data);
// $user->setStatus("Status");
// $user->setEmail("lucas@email.com");
// $user->setPassword("senha");

// UserRepository::save($user);

var_dump(UserRepository::findById(1));
?>