<?php

namespace PhpLab\Sandbox\RestClient\Domain\Entities;

class AccessEntity
{

    private $userId = null;

    private $projectId = null;

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


}

