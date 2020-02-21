<?php

namespace PhpLab\Sandbox\RestClient\Domain\Entities;

use PhpLab\Core\Domain\Interfaces\Entity\EntityIdInterface;

class ProjectEntity implements EntityIdInterface
{

    private $id = null;

    private $name = null;

    private $title = null;

    private $url = null;

    private $status = null;

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($value)
    {
        $this->name = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setTitle($value)
    {
        $this->title = $value;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setUrl($value)
    {
        $this->url = $value;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setStatus($value)
    {
        $this->status = $value;
    }

    public function getStatus()
    {
        return $this->status;
    }


}

