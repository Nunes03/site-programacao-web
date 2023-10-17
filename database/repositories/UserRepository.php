<?php
include "../Database.php";
include "../../converters/UserConverter.php";

class UserRepository {

    //private static $FIND_ALL_SQL = "";

    public static function findAll() {
        Database::executeQuery("select * from user;", new UserConverter());
    }
}
?>