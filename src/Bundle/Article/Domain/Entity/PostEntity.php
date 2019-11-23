<?php

namespace PhpLab\Sandbox\Bundle\Article\Domain\Entity;

use DateTime;
use PhpLab\Domain\Data\Collection;
use PhpLab\Domain\Interfaces\ValidateEntityInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class PostEntity implements ValidateEntityInterface
{

    private $id;
    private $categoryId;
    private $title;
    private $createdAt;

    private $category;
    private $tags;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function setCategoryId($categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory(CategoryEntity $category): void
    {
        $this->category = $category;
    }

    public function __construct()
    {
        $this->createdAt = new DateTime;
    }

    public function setCreatedAt($value)
    {
        $this->createdAt = new DateTime($value);
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags(Collection $tags): void
    {
        $this->tags = $tags;
    }

    public function validationRules() : array {
        return [
            'title' => [
                new Length(['min' => 3]),
                new NotBlank,
            ],
            'created_at' => [
                new \Symfony\Component\Validator\Constraints\DateTime,
            ],
        ];
    }

}
