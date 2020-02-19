<?php

namespace PhpLab\Sandbox\RestClient\Domain\Services;

use PhpLab\Core\Domain\Helpers\EntityHelper;
use PhpLab\Core\Exceptions\NotFoundException;
use PhpLab\Sandbox\RestClient\Domain\Entities\BookmarkEntity;
use PhpLab\Sandbox\RestClient\Domain\Enums\StatusEnum;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Services\BookmarkServiceInterface;
use PhpLab\Core\Domain\Base\BaseCrudService;

class BookmarkService extends BaseCrudService implements BookmarkServiceInterface
{

    public function __construct(\PhpLab\Sandbox\RestClient\Domain\Interfaces\Repositories\BookmarkRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function createOrUpdate(array $data): BookmarkEntity {
        $bookmarkEntity = new BookmarkEntity;
        unset($data['id']);
        EntityHelper::setAttributes($bookmarkEntity, $data);
        try {
            $bookmarkEntity = $this->repository->oneByHash($bookmarkEntity->getHash());
            $this->repository->update($bookmarkEntity);
        } catch (NotFoundException $e) {
            $bookmarkEntity->setStatus(StatusEnum::HISTORY);
            $this->repository->create($bookmarkEntity);
        }
        return $bookmarkEntity;
    }

    public function addToCollection(string $hash) {
        $bookmarkEntity = $this->repository->oneByHash($hash);
        $bookmarkEntity->setStatus(StatusEnum::FAVORITE);
        $this->repository->update($bookmarkEntity);
    }

    public function removeByHash(string $hash) {
        return $this->repository->removeByHash($hash);
    }

    public function oneByHash(string $hash): BookmarkEntity {
        return $this->repository->oneByHash($hash);
    }

    public function allFavoriteByProject(int $projectId) {
        return $this->repository->allFavoriteByProject($projectId);
    }

    public function allHistoryByProject(int $projectId) {
        return $this->repository->allHistoryByProject($projectId);
    }

    public function clearHistory(int $projectId) {
        return $this->repository->clearHistory($projectId);
    }
}

