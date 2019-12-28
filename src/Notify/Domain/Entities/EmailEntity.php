<?php

namespace PhpLab\Sandbox\Notify\Domain\Entities;

class EmailEntity
{

    private $from;
    private $to;
    private $subject;
    private $body;
    private $attachments;

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($from): void
    {
        $this->from = $from;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to): void
    {
        $this->to = $to;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body): void
    {
        $this->body = $body;
    }

    public function getAttachments()
    {
        return $this->attachments;
    }

    public function setAttachments($attachments): void
    {
        $this->attachments = $attachments;
    }

}
