<?php

namespace PhpLab\Sandbox\RestClient\Domain\Interfaces\Repositories;

use Illuminate\Support\Collection;
use PhpLab\Core\Domain\Interfaces\Repository\CrudRepositoryInterface;
use PhpLab\Sandbox\RestClient\Domain\Entities\BookmarkEntity;

interface BookmarkRepositoryInterface extends CrudRepositoryInterface
{

    public function removeByHash(string $hash): void;

    public function oneByHash(string $hash): BookmarkEntity;

    public function allFavoriteByProject(int $projectId): Collection;

    public function allHistoryByProject(int $projectId): Collection;

    public function clearHistory(int $projectId): void;
}

