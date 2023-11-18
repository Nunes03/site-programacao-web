<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Dto/PostDto.php");

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
     * @var int
     */
    private $likes;

    /**
     * @var string
     */
    private $fileName;

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
     * @return int
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param int $likes
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;
    }

    /**
     * @param string $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
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

    /**
     * @return PostDto
     */
    public function toDto()
    {
        $postDto = new PostDto();
        $postDto->id = $this->getId();
        $postDto->content = $this->getContent();
        $postDto->date = $this->getDate();
        $postDto->likes = $this->getLikes();
        $postDto->fileName = $this->getFileName();
        $postDto->user = $this->getUser()->toDto();

        return $postDto;
    }
}
