<?php

namespace PhpLab\Sandbox\RestClient\Domain\Repositories\Eloquent;

use PhpLab\Core\Domain\Libs\Query;
use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use PhpLab\Sandbox\RestClient\Domain\Entities\BookmarkEntity;
use PhpLab\Sandbox\RestClient\Domain\Enums\StatusEnum;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Repositories\BookmarkRepositoryInterface;

class BookmarkRepository extends BaseEloquentCrudRepository implements BookmarkRepositoryInterface
{

    protected $tableName = 'restclient_bookmark';

    protected $entityClass = BookmarkEntity::class;

    public function removeByHash(string $hash) {
        $bookmarkEntity =  $this->oneByHash($hash);
        $this->deleteById($bookmarkEntity->getId());
    }

    public function oneByHash(string $hash): BookmarkEntity {
        $query = new Query;
        $query->where('hash', $hash);
        return $this->one($query);
    }

    public function allFavoriteByProject(int $projectId) {
        $query = new Query;
        $query->where('status', StatusEnum::FAVORITE);
        $query->where('project_id', $projectId);
        return $this->all($query);
    }

    public function allHistoryByProject(int $projectId) {
        $query = new Query;
        $query->where('status', StatusEnum::HISTORY);
        $query->where('project_id', $projectId);
        return $this->all($query);
    }

    public function clearHistory(int $projectId) {
        $this->deleteByCondition([
            'project_id' => $projectId,
            'status' => StatusEnum::HISTORY,
        ]);
    }

}

