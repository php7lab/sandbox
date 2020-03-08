<?php

namespace PhpLab\Sandbox\Messenger\Domain\Entities;

use PhpLab\Core\Domain\Interfaces\Entity\EntityIdInterface;

class FlowEntity implements EntityIdInterface
{

    private $id;
    private $contentId;
    private $chatId;
    private $isSeen;
    //private $text;
    private $message;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getContentId()
    {
        return $this->contentId;
    }

    public function setContentId($contentId): void
    {
        $this->contentId = $contentId;
    }

    public function getChatId()
    {
        return $this->chatId;
    }

    public function getisSeen()
    {
        return $this->isSeen;
    }

    public function setIsSeen($isSeen): void
    {
        $this->isSeen = $isSeen;
    }

    public function setChatId($chatId): void
    {
        $this->chatId = $chatId;
    }

    /*public function getText()
    {
        return $this->getMessage()->getText();
    }*/

    public function getMessage(): MessageEntity
    {
        return $this->message;
    }

    public function setMessage(MessageEntity $message): void
    {
        $this->message = $message;
    }

}