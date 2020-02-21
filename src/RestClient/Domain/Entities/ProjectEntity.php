<?php

namespace PhpLab\Sandbox\RestClient\Domain\Entities;

use PhpLab\Core\Domain\Interfaces\Entity\EntityIdInterface;
use PhpLab\Core\Domain\Interfaces\Entity\ValidateEntityInterface;
use PhpLab\Core\Enums\StatusEnum;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Url;

class ProjectEntity implements EntityIdInterface, ValidateEntityInterface
{

    private $id = null;

    private $name = null;

    private $title = null;

    private $url = null;

    private $status = StatusEnum::ENABLE;

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

    public function validationRules(): array
    {
        return [
            'name' => [
                new NotBlank,
                new Regex(['pattern' => '/[a-zA-Z0-9-]+/i']),
            ],
            'title' => [
                new NotBlank,
            ],
            'url' => [
                new NotBlank,
                new Url,
            ],
            'status' => [
                new NotBlank,
            ],
        ];
    }
}

