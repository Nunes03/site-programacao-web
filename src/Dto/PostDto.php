<?php

class PostDto
{

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $content;

    /**
     * @var DateTime
     */
    public $date;

    /**
     * @var int
     */
    public $likes;

    /**
     * @var string
     */
    public $fileName;

    /**
     * @var UserDto
     */
    public $user;
}
