<?php

define("PROFILE_PREFIX", __DIR__ . "\\Profile\\");

define("POST_PREFIX", __DIR__ . "\\Post\\");

class UserFileManagement
{

    /**
     * @param $email string
     * @param $fileName string
     * @param $fileContent string
     * @return string Nome do arquivo criado
     */
    public static function saveProfileFile($email, $fileName, $fileContent)
    {
        $folderName = self::buildUserFolderName($email, PROFILE_PREFIX);
        $folderExist = self::existUserFolder($email, PROFILE_PREFIX);

        if (!$folderExist) {
            self::createUserFolder($email, PROFILE_PREFIX);
        }

        self::deleteAllFilesFromFolder($folderName);
        file_put_contents($folderName . "\\" . $fileName, $fileContent);

        return $fileName;
    }

    /**
     * @param $email string
     * @param $fileName string
     * @param $fileExtension string
     * @param $fileContent string
     * @return string Nome do arquivo criado
     */
    public static function savePostFile($email, $fileName, $fileExtension, $fileContent)
    {
        $folderName = self::buildUserFolderName($email, POST_PREFIX);
        $folderExist = self::existUserFolder($email, POST_PREFIX);

        if (!$folderExist) {
            self::createUserFolder($email, POST_PREFIX);
        }

        $currentDate = self::getCurrentDateString();
        $fileName = $fileName . $currentDate . "." . $fileExtension;
        file_put_contents($folderName . "\\" . $fileName, $fileContent);

        return $fileName;
    }

    /**
     * @param $email string
     * @return bool
     */
    private static function existUserFolder($email, $folderPrefix)
    {
        $folderName = self::buildUserFolderName($email, $folderPrefix);

        return file_exists($folderName) && is_dir($folderName);
    }

    /**
     * @param $email string
     * @return void
     */
    private static function createUserFolder($email, $folderPrefix)
    {
        $folderName = self::buildUserFolderName($email, $folderPrefix);

        mkdir($folderName, 0777, true);
    }

    /**
     * @param $email string
     * @return string
     */
    private static function buildUserFolderName($email, $folderPrefix)
    {
        $userFolder = str_replace(array("@", "."), "_", $email);

        return $folderPrefix . $userFolder;
    }

    /**
     * @param $folderName string
     * @return void
     */
    private static function deleteAllFilesFromFolder($folderName)
    {
        $folder = opendir($folderName);

        while (($file = readdir($folder)) !== false) {
            if ($file != "." && $file != "..") {
                $fileName = $folderName . "\\" . $file;

                unlink($fileName);
            }
        }

        closedir($folder);
    }

    /**
     * @return string
     */
    private static function getCurrentDateString()
    {
        return date('YmdHis', time());
    }
}
