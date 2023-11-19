<?php

class DatabaseConnectionDto
{
    /**
     * @var string
     */
    public $hostname;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $databaseName;

    /**
     * @param string $hostname
     * @param string $username
     * @param string $password
     * @param string $databaseName
     */
    public function __construct($hostname, $username, $password, $databaseName)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->databaseName = $databaseName;
    }
}
