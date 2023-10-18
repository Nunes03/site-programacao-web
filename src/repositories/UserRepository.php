<?php

namespace repositories;

use converters\UserConverter;
use database\ConnectionDatabase;

define("FIND_ALL_SQL", "select * from user;");

class UserRepository
{

    public static function findAll()
    {
        return ConnectionDatabase::executeQuery(FIND_ALL_SQL, new UserConverter());
    }
}
