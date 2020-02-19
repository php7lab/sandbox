<?php

namespace PhpLab\Sandbox\RestClient\Domain\Entities;

use PhpLab\Bundle\Crypt\Enums\HashAlgoEnum;
use PhpLab\Bundle\Crypt\Helpers\SafeBase64Helper;
use PhpLab\Core\Domain\Interfaces\ValidateEntityInterface;
use PhpLab\Sandbox\RestClient\Domain\Helpers\BookmarkHelper;
use Symfony\Component\Validator\Constraints\NotBlank;

class BookmarkEntity implements ValidateEntityInterface
{

    private $id = null;
    private $hash = null;
    private $projectId = null;
    private $method = null;
    private $uri = null;

    private $query = null;
    private $body = null;
    private $header = null;

    private $queryData = null;
    private $bodyData = null;
    private $headerData = null;

    private $authorization = null;
    private $description = null;
    private $status = null;

    public function validationRules(): array
    {
        return [
            'hash' => [
                new NotBlank,
            ],
            'projectId' => [
                new NotBlank,
            ],
            'method' => [
                new NotBlank,
            ],
            'uri' => [
                new NotBlank,
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

    public function setHash($value)
    {
        $this->hash = $value;
    }

    public function getHash()
    {
        if($this->hash) {
            return $this->hash;
        }
        return BookmarkHelper::generateHash($this);
    }

    public function setProjectId($value)
    {
        $this->projectId = $value;
    }

    public function getProjectId()
    {
        return $this->projectId;
    }

    public function setMethod($value)
    {
        $this->method = $value;
    }

    public function getMethod()
    {
        return strtolower($this->method);
    }

    public function setUri($value)
    {
        $this->uri = $value;
    }

    public function getUri()
    {
        return $this->uri;
    }




    public function setQuery($value)
    {
        $this->query = $value;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function setBody($value)
    {
        $this->body = $value;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setHeader($value)
    {
        $this->header = $value;
    }

    public function getHeader()
    {
        return $this->header;
    }




    public function setQueryData($value)
    {
        $this->query = json_decode($value);
    }

    public function getQueryData()
    {
        return json_encode($this->query);
    }

    public function setBodyData($value)
    {
        $this->body = json_decode($value);
    }

    public function getBodyData()
    {
        return json_encode($this->body);
    }

    public function setHeaderData($value)
    {
        $this->header = json_decode($value);
    }

    public function getHeaderData()
    {
        return json_encode($this->header);
    }




    public function setAuthorization($value)
    {
        $this->authorization = $value;
    }

    public function getAuthorization()
    {
        return $this->authorization;
    }

    public function setDescription($value)
    {
        $this->description = $value;
    }

    public function getDescription()
    {
        return $this->description;
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

