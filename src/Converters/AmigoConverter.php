<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../Database/Entities/AmigoEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/Interfaces/ConverterInterface.php");

class AmigoConverter implements ConverterInterface {

    public function convert($resultSet) {

        $amigoEntities = array();

        if($resultSet) {
            $amountRegister = 0;

            while($row = mysqli_fetch_array($resultSet)) {
                $amigoEntities[$amountRegister] = $this->convertRow($row);
                $amountRegister++;
            }
        }

        return $amigoEntities;
    }

    private function convertRow($row) {
        $amigoEntity = new AmigoEntity();
        $amigoEntity->setId($row["id"]);
        $amigoEntity->setUserEmail($row["email_user"]);
        $amigoEntity->setAmigoEmail($row["email_amigo"]);

        return $amigoEntity;
    }
}
