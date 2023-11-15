<?php

interface ConverterInterface
{
    /**
     * @param $resultSet mysqli_result
     * @return array
     */
    public function convert($resultSet);
}
