<?php

class PostEntity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $content;

    /**
     * @var DateTime
     */
    private $date;

    /**
     * @var UserEntity
     */
    private $user;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return UserEntity
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param UserEntity $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
}
