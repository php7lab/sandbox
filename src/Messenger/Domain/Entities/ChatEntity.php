<?php

namespace PhpLab\Sandbox\Messenger\Domain\Entities;

use Illuminate\Support\Collection;
use PhpLab\Core\Domain\Interfaces\Entity\EntityIdInterface;

class ChatEntity implements EntityIdInterface
{

    private $id;
    private $title;
    private $type;
    private $messages;
    private $members;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type): void
    {
        $this->type = $type;
    }

    public function getMessages()
    {
        return $this->messages;
    }

    public function setMessages(Collection $messages): void
    {
        $this->messages = $messages;
    }

    public function getMembers()
    {
        return $this->members;
    }

    public function setMembers($members): void
    {
        $this->members = $members;
    }

}