<?php

namespace PhpLab\Sandbox\Package\Domain\Repositories\File;

use Illuminate\Support\Collection;
use php7extension\yii\helpers\FileHelper;
use php7rails\domain\data\Query;
use php7tool\vendor\domain\helpers\GitShell;
use PhpLab\Domain\Repositories\BaseRepository;
use PhpLab\Sandbox\Package\Domain\Entities\GroupEntity;
use PhpLab\Sandbox\Package\Domain\Entities\PackageEntity;
use PhpLab\Sandbox\Package\Domain\Interfaces\Repositories\PackageRepositoryInterface;

class PackageRepository extends BaseRepository implements PackageRepositoryInterface
{

    const VENDOR_DIR = __DIR__ . '/../../../../../../..';

    protected $tableName = '';
    protected $entityClass = PackageEntity::class;
    private $groupRepostory;

    public function __construct(GroupRepository $groupRepostory)
    {
        $this->groupRepostory = $groupRepostory;
    }

    public function allChanged(Query $query = null) {
        /** @var PackageEntity[] $packageCollection */
        $packageCollection = $this->all();
        $vendorDir = realpath(self::VENDOR_DIR);
        $changedCollection = new Collection;
        foreach ($packageCollection as $packageEntity) {
            $dir = $vendorDir . DIRECTORY_SEPARATOR . $packageEntity->getId();
            $shell = new GitShell($dir);
            $hasChanges = $shell->hasChanges();
            if($hasChanges) {
                $changedCollection->add($packageEntity);
            }
        }
        return $changedCollection;
    }

    public function all(Query $query = null)
    {
        $vendorDir = realpath(self::VENDOR_DIR);
        /** @var GroupEntity[] $groupCollection */
        $groupCollection = $this->groupRepostory->all();
        $collection = new Collection;
        foreach ($groupCollection as $groupEntity) {
            $dir = $vendorDir . DIRECTORY_SEPARATOR . $groupEntity->name;
            $names = FileHelper::scanDir($dir);
            foreach ($names as $name) {
                $packageEntity = new PackageEntity;
                $packageEntity->setName($name);
                $packageEntity->setGroup($groupEntity);
                $collection->add($packageEntity);
            }
        }
        return $collection;
    }

    public function count(Query $query = null): int
    {
        return count($this->all($query));
    }

    public function oneById($id, Query $query = null)
    {
        // TODO: Implement oneById() method.
    }

    public function relations()
    {
        // TODO: Implement relations() method.
    }
}
