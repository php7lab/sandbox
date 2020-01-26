<?php

namespace PhpLab\Sandbox\Package\Domain\Repositories\File;

use PhpLab\Domain\Data\Query;
use PhpLab\Domain\Interfaces\Repository\ReadRepositoryInterface;
use PhpLab\Domain\Base\BaseRepository;
use PhpLab\Sandbox\Common\Libs\Store\StoreFile;
use PhpLab\Sandbox\Package\Domain\Entities\GroupEntity;

class GroupRepository extends BaseRepository implements ReadRepositoryInterface
{

    private $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function all(Query $query = null)
    {
        $store = new StoreFile($this->fileName);
        $array = $store->load();
        $collection = $this->forgeEntityCollection($array);
        return $collection;
    }

    public function count(Query $query = null): int
    {
        $collection = $this->all($query);
        return $collection->count();
    }

    public function oneById($id, Query $query = null)
    {
        // TODO: Implement oneById() method.
    }

    public function getEntityClass(): string
    {
        return GroupEntity::class;
    }

    public function relations()
    {
        return [];
    }

}
