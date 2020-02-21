<?php

namespace PhpLab\Sandbox\RestClient\Domain\Entities;

use PhpLab\Core\Domain\Interfaces\Entity\EntityIdInterface;
use PhpLab\Core\Domain\Interfaces\Entity\ValidateEntityInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class AccessEntity implements EntityIdInterface, ValidateEntityInterface
{

    private $id = null;

    private $userId = null;

    private $projectId = null;

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUserId($value)
    {
        $this->userId = $value;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setProjectId($value)
    {
        $this->projectId = $value;
    }

    public function getProjectId()
    {
        return $this->projectId;
    }

    public function validationRules(): array
    {
        return [
            'userId' => [
                new NotBlank,
                new Positive,

            ],
            'projectId' => [
                new NotBlank,
                new Positive,
            ],
        ];
    }
}
