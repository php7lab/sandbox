<?php

namespace PhpLab\Sandbox\Reference\Entities;

use Illuminate\Support\Collection;
use PhpLab\Core\Legacy\Yii\Helpers\Inflector;
use Symfony\Component\Validator\Constraints as Assert;
use PhpLab\Core\Domain\Interfaces\Entity\ValidateEntityInterface;
use PhpLab\Core\Domain\Interfaces\Entity\EntityIdInterface;

class ItemEntity implements ValidateEntityInterface, EntityIdInterface
{

    private $id = null;
    private $bookId = null;
    private $parentId = null;
    private $code = null;
    private $title = null;
    private $shortTitle = null;
    private $entity = null;
    private $status = null;
    private $sort = null;
    private $props = null;
    private $createdAt = null;
    private $updatedAt = null;

    /** @var Collection | ItemTranslationEntity[] */
    private $translations = null;

    public function validationRules()
    {
        return [];
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setBookId($value)
    {
        $this->bookId = $value;
    }

    public function getBookId()
    {
        return $this->bookId;
    }

    public function setParentId($value)
    {
        $this->parentId = $value;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function setCode($value)
    {
        $this->code = $value;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getTitle()
    {
        if(empty($this->title) && $this->translations->count()) {
            /** @var ItemTranslationEntity $translationEntity */
            $translationEntity = $this->translations->first();
            $this->title = $translationEntity->getTitle();
        }
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getShortTitle()
    {
        if(empty($this->shortTitle) && $this->translations->count()) {
            /** @var ItemTranslationEntity $translationEntity */
            $translationEntity = $this->translations->first();
            $this->shortTitle = $translationEntity->getShortTitle();
        }
        return $this->shortTitle;
    }

    public function setShortTitle($shortTitle): void
    {
        $this->shortTitle = $shortTitle;
    }

    public function setEntity($value)
    {
        $this->entity = $value;
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function setStatus($value)
    {
        $this->status = $value;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getSort()
    {
        return $this->sort;
    }

    public function setSort($sort): void
    {
        $this->sort = $sort;
    }

    public function setProps($value)
    {
        $this->props = $value;
    }

    public function getProps()
    {
        return $this->props;
    }

    public function setCreatedAt($value)
    {
        $this->createdAt = $value;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setUpdatedAt($value)
    {
        $this->updatedAt = $value;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function setTranslations(Collection $translations): void
    {
        $this->translations = $translations;
    }

}

