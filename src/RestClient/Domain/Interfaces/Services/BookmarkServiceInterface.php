<?php

namespace PhpLab\Sandbox\RestClient\Domain\Interfaces\Services;

use PhpLab\Core\Domain\Exceptions\UnprocessibleEntityException;
use PhpLab\Core\Domain\Interfaces\Service\CrudServiceInterface;
use PhpLab\Core\Exceptions\NotFoundException;
use PhpLab\Sandbox\RestClient\Domain\Entities\BookmarkEntity;

interface BookmarkServiceInterface extends CrudServiceInterface
{

    /**
     * @param array $data
     * @return BookmarkEntity
     * @throws UnprocessibleEntityException
     */
    public function createOrUpdate(array $data): BookmarkEntity;

    /**
     * @param string $hash
     * @return void
     */
    public function addToCollection(string $hash);

    /**
     * @param string $hash
     * @return void
     * @throws NotFoundException
     */
    public function removeByHash(string $hash);

    /**
     * @param string $hash
     * @return BookmarkEntity
     * @throws NotFoundException
     */
    public function oneByHash(string $hash): BookmarkEntity;

    /**
     * @param int $projectId
     * @return mixed
     */
    public function allFavoriteByProject(int $projectId);

    /**
     * @param int $projectId
     * @return mixed
     */
    public function allHistoryByProject(int $projectId);

    /**
     * @param int $projectId
     * @return mixed
     */
    public function clearHistory(int $projectId);
}

