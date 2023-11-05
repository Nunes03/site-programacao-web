<?php
require __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../Database/Entities/PostEntity.php");
require __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../Database/Entities/UserEntity.php");
require __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/Interfaces/ConverterInterface.php");

class PostConverter implements ConverterInterface
{

    /**
     * @param $resultSet mysqli_result
     * @return array
     */
    public function convert($resultSet)
    {
        $postEntities = array();

        if ($resultSet) {
            $amountRegister = 0;

            while ($row = mysqli_fetch_array($resultSet)) {
                $postEntities[$amountRegister] = $this->convertRow($row);
                $amountRegister++;
            }
        }

        return $postEntities;
    }

    /**
     * @param $row array
     * @return PostEntity
     */
    private function convertRow($row)
    {
        $postEntity = new PostEntity();
        $postEntity->setId($row["id"]);
        $postEntity->setContent($row["content"]);
        $postEntity->setDate($row["date"]);

        $userEntity = new UserEntity();
        $userEntity->setId($row["user_id"]);
        $postEntity->setUser($userEntity);

        return $postEntity;
    }
}
