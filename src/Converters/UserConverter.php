<?php
require __DIR__.str_replace("/../Database/Entities/UserEntity.php", "/", DIRECTORY_SEPARATOR);

class UserConverter
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

//        $row["id"],
//            $row["nome"],
//            $row["email"],
//            $row["password"]

        return $userEntity;
    }
}

?>