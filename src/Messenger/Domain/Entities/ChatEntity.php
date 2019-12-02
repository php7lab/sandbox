<?php

namespace PhpLab\Sandbox\Messenger\Domain\Entities;

use PhpLab\Domain\Data\Collection;

class ChatEntity
{

    private $id;
    private $title;
    private $type;
    private $messages;

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

}