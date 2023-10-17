<?php
include "interfaces/ConverterInterface.php";

class UserConverter implements ConverterInterface {

    public function __construct() {
    }

    public function convert($resultSet) {
        echo("Convertido");
    }
}
?>