<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../Dto/UserDto.php");

class UserEntity
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var DateTime
     */
    private $birthday;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $photoFileName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param DateTime $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getPhotoFileName()
    {
        return $this->photoFileName;
    }

    /**
     * @param string $photo
     */
    public function setPhotoFileName($photo)
    {
        $this->photoFileName = $photo;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return UserDto
     */
    public function toDto()
    {
        $userDto = new UserDto();
        $userDto->id = $this->getId();
        $userDto->name = $this->getName();
        $userDto->lastName = $this->getLastName();
        $userDto->birthday = $this->getBirthday();
        $userDto->status = $this->getStatus();
        $userDto->photoFileName = $this->getPhotoFileName();
        $userDto->email = $this->getEmail();

        return $userDto;
    }
}

