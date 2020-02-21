<?php

namespace PhpLab\Sandbox\RestClient\Domain\Services;

use PhpLab\Core\Exceptions\NotFoundException;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Repositories\AccessRepositoryInterface;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Repositories\BookmarkRepositoryInterface;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Repositories\ProjectRepositoryInterface;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Services\ProjectServiceInterface;
use PhpLab\Core\Domain\Base\BaseCrudService;
use yii\web\NotFoundHttpException;

class ProjectService extends BaseCrudService implements ProjectServiceInterface
{

    private $bookmarkRepository;
    private $accessRepository;

    public function __construct(
        ProjectRepositoryInterface $repository,
        BookmarkRepositoryInterface $bookmarkRepository,
        AccessRepositoryInterface $accessRepository
    )
    {
        $this->repository = $repository;
        $this->bookmarkRepository = $bookmarkRepository;
        $this->accessRepository = $accessRepository;
    }

    public function isAllowProject(int $projectId, int $userId)
    {
        try {
            $this->accessRepository->oneByTie($projectId, $userId);
            return true;
        } catch (NotFoundException $e) {
            return false;
        }
    }

    public function oneByName(string $projectName)
    {
        return $this->repository->oneByName($projectName);
    }

    public function projectNameByHash(string $tag): string
    {
        try {
            $bookmarkEntity = $this->bookmarkRepository->oneByHash($tag);
        } catch (NotFoundException $e) {
            throw new NotFoundHttpException('Project not found!');
        }

        try {
            $projectEntity = $this->oneById($bookmarkEntity->getProjectId());
        } catch (NotFoundException $e) {
            throw new NotFoundHttpException('Project not found!');
        }
        return $projectEntity->getName();
    }
}

