<?php

class Util
{
    public static function base64ToObject($base64)
    {
        $jsonObject = base64_decode($base64);

        return json_decode($jsonObject);
    }

    public static function objectToBase64($object)
    {
        $json = json_encode($object);

        return base64_encode($json);
    }
}
