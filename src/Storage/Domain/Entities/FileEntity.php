<?php

namespace PhpLab\Sandbox\Storage\Domain\Entities;

use PhpLab\Core\Domain\Interfaces\Entity\EntityIdInterface;

class FileEntity implements EntityIdInterface
{

    private $id = null;
    private $serviceId = null;
    private $entityId = null;
    private $authorId = null;
    private $hash = null;
    private $extension = null;
    private $size = null;
    private $name = null;
    private $description = null;
    private $status = null;
    private $createdAt = null;
    private $updatedAt = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getServiceId()
    {
        return $this->serviceId;
    }

    public function setServiceId($serviceId): void
    {
        $this->serviceId = $serviceId;
    }

    public function getEntityId()
    {
        return $this->entityId;
    }

    public function setEntityId($entityId): void
    {
        $this->entityId = $entityId;
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function setAuthorId($authorId): void
    {
        $this->authorId = $authorId;
    }

    public function getHash()
    {
        return $this->hash;
    }

    public function setHash($hash): void
    {
        $this->hash = $hash;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function setExtension($extension): void
    {
        $this->extension = $extension;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size): void
    {
        $this->size = $size;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }


}

