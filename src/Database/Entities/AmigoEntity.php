<?php

require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Dto/AmigoDto.php");

class AmigoEntity {

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $email_user;

    /**
     * @var string
     */
    private $email_amigo;

    /**
     * @return int $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * @return string $email_user
     */
    public function getUserEmail() {
        return $this->email_user;
    }

    /**
     * @param string $email_user
     */
    public function setUserEmail($email_user) {
        $this->email_user = $email_user;
    }

    /**
     * @return string
     */
    public function getAmigoEmail() {
        return $this->email_amigo;
    }

    /**
     * @param string $email_amigo
     */
    public function setAmigoEmail($email_amigo) {
        $this->email_amigo = $email_amigo;
    }

    /**
     * @return AmigoDto
     */
    public function toDto() {
        $amigoDto = new AmigoDto();
        $amigoDto->email_user = $this->getUserEmail();
        $amigoDto->email_amigo = $this->getAmigoEmail();

        return $amigoDto;
    }
}