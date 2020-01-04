<?php

namespace PhpLab\Sandbox\Package\Domain\Repositories\File;

use Illuminate\Support\Collection;
use php7rails\domain\data\Query;
use php7tool\vendor\domain\helpers\GitShell;
use PhpLab\Sandbox\Package\Domain\Interfaces\Repositories\GitRepositoryInterface;
use PhpLab\Sandbox\Package\Domain\Entities\GitEntity;
use PhpLab\Domain\Repositories\BaseRepository;

class GitRepository extends BaseRepository implements GitRepositoryInterface {

    const VENDOR_DIR = __DIR__ . '/../../../../../../..';

    protected $tableName = '';
    protected $entityClass = GitEntity::class;
    private $packageRepostory;

    public function __construct(PackageRepository $packageRepostory)
    {
        $this->packageRepostory = $packageRepostory;
    }

    public function allChanged()
    {
        /** @var PackageEntity[] $packageCollection */
        $packageCollection = $this->packageRepostory->all();
        $vendorDir = realpath(self::VENDOR_DIR);
        $changedCollection = new Collection;
        foreach ($packageCollection as $packageEntity) {
            $dir = $vendorDir . DIRECTORY_SEPARATOR . $packageEntity->getId();
            $shell = new GitShell($dir);
            $hasChanges = $shell->hasChanges();
            if ($hasChanges) {
                $changedCollection->add($packageEntity);
            }
        }
        return $changedCollection;
    }
}
