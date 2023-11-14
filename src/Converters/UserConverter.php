<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../Database/Entities/UserEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/Interfaces/ConverterInterface.php");

class UserConverter implements ConverterInterface
{

    public function convert($resultSet)
    {
        $userEntities = array();

        if ($resultSet) {
            $amountRegister = 0;

            while ($row = mysqli_fetch_array($resultSet)) {
                $userEntities[$amountRegister] = $this->convertRow($row);
                $amountRegister++;
            }
        }

        return $userEntities;
    }

    private function convertRow($row)
    {
        $userEntity = new UserEntity();
        $userEntity->setId($row["id"]);
        $userEntity->setName($row["name"]);
        $userEntity->setLastName($row["last_name"]);
        $userEntity->setBirthday($row["birthday"]);
        $userEntity->setStatus($row["status"]);
        $userEntity->setPhotoFileName($row["photo_file_name"]);
        $userEntity->setEmail($row["email"]);
        $userEntity->setPassword($row["password"]);

        return $userEntity;
    }
}
