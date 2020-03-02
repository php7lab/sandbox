<?php

namespace PhpLab\Sandbox\Example\Domain\Entities;

use PhpLab\Core\Domain\Interfaces\Entity\EntityIdInterface;
use PhpLab\Core\Domain\Interfaces\Entity\ValidateEntityInterface;
use Symfony\Component\Validator\Constraints as Assert;

class BookEntity implements ValidateEntityInterface, EntityIdInterface
{

    private $id = null;
    private $title = null;
    private $levels = null;
    private $entity = null;
    private $props = null;
    private $status = null;
    private $createdAt = null;
    private $updatedAt = null;

    public function validationRules()
    {
        return [
            'title' => [
                new Assert\NotBlank,
                new Assert\Length([
                    'min' => 3,
                    'max' => 50,
                ]),
            ],
            'levels' => [
                new Assert\NotBlank,
                new Assert\Positive,
            ],
            'status' => [
                new Assert\NotBlank,
                new Assert\Positive,
            ],
        ];
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($value)
    {
        $this->title = $value;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setLevels($value)
    {
        $this->levels = $value;
    }

    public function getLevels()
    {
        return $this->levels;
    }

    public function setEntity($value)
    {
        $this->entity = $value;
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function setProps($value)
    {
        $this->props = $value;
    }

    public function getProps()
    {
        return $this->props;
    }

    public function setStatus($value)
    {
        $this->status = $value;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setCreatedAt($value)
    {
        $this->createdAt = $value;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setUpdatedAt($value)
    {
        $this->updatedAt = $value;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

}
