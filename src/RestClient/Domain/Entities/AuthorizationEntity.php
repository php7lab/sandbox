<?php

namespace PhpLab\Sandbox\RestClient\Domain\Entities;

class AuthorizationEntity
{

    private $id = null;

    private $projectId = null;

    private $type = null;

    private $username = null;

    private $password = null;

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setProjectId($value)
    {
        $this->projectId = $value;
    }

    public function getProjectId()
    {
        return $this->projectId;
    }

    public function setType($value)
    {
        $this->type = $value;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setUsername($value)
    {
        $this->username = $value;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setPassword($value)
    {
        $this->password = $value;
    }

    public function getPassword()
    {
        return null; // $this->password;
    }

    public function getHiddenPassword()
    {
        return $this->password;
    }
}

