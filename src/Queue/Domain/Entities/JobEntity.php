<?php

namespace PhpLab\Sandbox\Queue\Domain\Entities;

class JobEntity
{

    private $id;
    private $channel;
    private $class;
    private $data;
    private $priority;
    private $delay;
    private $attempt;
    private $pushedAt;
    private $reservedAt;
    private $doneAt;

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
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @param mixed $channel
     */
    public function setChannel($channel): void
    {
        $this->channel = $channel;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     */
    public function setClass($class): void
    {
        $this->class = $class;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param mixed $priority
     */
    public function setPriority($priority): void
    {
        $this->priority = $priority;
    }

    /**
     * @return mixed
     */
    public function getDelay()
    {
        return $this->delay;
    }

    /**
     * @param mixed $delay
     */
    public function setDelay($delay): void
    {
        $this->delay = $delay;
    }

    /**
     * @return mixed
     */
    public function getAttempt()
    {
        return $this->attempt;
    }

    /**
     * @param mixed $attempt
     */
    public function setAttempt($attempt): void
    {
        $this->attempt = $attempt;
    }

    /**
     * @return mixed
     */
    public function getPushedAt()
    {
        return $this->pushedAt;
    }

    /**
     * @param mixed $pushedAt
     */
    public function setPushedAt($pushedAt): void
    {
        $this->pushedAt = $pushedAt;
    }

    /**
     * @return mixed
     */
    public function getReservedAt()
    {
        return $this->reservedAt;
    }

    /**
     * @param mixed $reservedAt
     */
    public function setReservedAt($reservedAt): void
    {
        $this->reservedAt = $reservedAt;
    }

    /**
     * @return mixed
     */
    public function getDoneAt()
    {
        return $this->doneAt;
    }

    /**
     * @param mixed $doneAt
     */
    public function setDoneAt($doneAt): void
    {
        $this->doneAt = $doneAt;
    }

}
