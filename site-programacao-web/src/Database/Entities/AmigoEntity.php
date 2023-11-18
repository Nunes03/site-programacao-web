<?php

require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Dto/AmigoDto.php");

class AmigoEntity {

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $id_user;

    /**
     * @var int
     */
    private $id_amigo;

    /**
     * @return int
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getIdUser() {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     */
    public function setIdUser($id_user) {
        $this->id_user = $id_user;
    }

    /**
     * @return int
     */
    public function getIdAmigo() {
        return $this->id_amigo;
    }

    /**
     * @param int $id_amigo
     */
    public function setIdAmigo($id_amigo) {
        $this->id_amigo = $id_amigo;
    }

    /**
     * @return AmigoDto
     */
    public function toDto() {
        $amigoDto = new AmigoDto();
        $amigoDto->id_user = $this->getIdUser();
        $amigoDto->id_amigo = $this-getIdAmigo();

        return $amigoDto;
    }

}

?>