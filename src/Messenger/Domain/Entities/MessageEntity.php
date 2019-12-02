<?php

namespace PhpLab\Sandbox\Messenger\Domain\Entities;

use PhpLab\Sandbox\User\Domain\Entities\Identity;

class MessageEntity
{

    private $id;
    private $text;
    private $authorId;
    private $author;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @param mixed $authorId
     */
    public function setAuthorId($authorId): void
    {
        $this->authorId = $authorId;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        $author = new Identity;
        $author->setId($this->getAuthorId());
        $author->setUsername('User ' . $this->getAuthorId());
        return $author;
        //return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

}