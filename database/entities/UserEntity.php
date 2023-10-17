<?php
class UserEntity {

    private $id;

    private $nome;

    private $email;

    private $password;

    public function __construct() {
    }

    public function __construct($id, $nome, $email, $password) {
        $this->$id = $id;
        $this->$nome = $nome;
        $this->$email = $email;
        $this->$password = $password;
    }

    public function getId() {
        return $this->$id;
    }

    public function setId($id) {
        $this->$id = $id;
    }

    public function getNome() {
        return $this->$nome;
    }

    public function setId($nome) {
        $this->$nome = $nome;
    }

    public function getEmail() {
        return $this->$email;
    }

    public function setEmail($email) {
        $this->$email = $email;
    }

    public function getPassword() {
        return $this->$password;
    }

    public function setPassword($password) {
        $this->$password = $password;
    }
}
?>