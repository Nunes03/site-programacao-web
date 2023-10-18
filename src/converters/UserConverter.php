<?php

namespace converters;

use converters\interfaces\ConverterInterface;
use database\entities\UserEntity;

//include "interfaces/ConverterInterface.php";
//include "../database/entities/UserEntity.php";

class UserConverter implements ConverterInterface
{

    public function convert($resultSet)
    {
        $userEntities = array();

        if ($resultSet) {
            $amountRegister = 0;

            while ($row = mysqli_fetch_array($resultSet)) {
                $userEntities[$amountRegister] = $this->convertRow($row);
            }
        }

        return $userEntities;
    }

    private function convertRow($row)
    {
        $userEntity = new UserEntity();
        $userEntity->setId($row["id"]);
        $userEntity->setNome($row["nome"]);
        $userEntity->setEmail($row["email"]);
        $userEntity->setPassword($row["password"]);

        return $userEntity;
    }
}
