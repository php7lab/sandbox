<?php

namespace PhpLab\Sandbox\Package\Domain\Repositories\File;

use Illuminate\Support\Collection;
use PhpLab\Core\Domain\Helpers\EntityHelper;
use PhpLab\Core\Domain\Base\BaseRepository;
use PhpLab\Sandbox\Package\Domain\Entities\CommitEntity;
use PhpLab\Sandbox\Package\Domain\Entities\GitEntity;
use PhpLab\Sandbox\Package\Domain\Entities\PackageEntity;
use PhpLab\Sandbox\Package\Domain\Entities\TagEntity;
use PhpLab\Sandbox\Package\Domain\Interfaces\Repositories\GitRepositoryInterface;
use PhpLab\Sandbox\Package\Domain\Libs\GitShell;

class GitRepository extends BaseRepository implements GitRepositoryInterface
{

    const VENDOR_DIR = __DIR__ . '/../../../../../../..';

    protected $tableName = '';
    protected $entityClass = GitEntity::class;
    private $packageRepostory;

    public function __construct(PackageRepository $packageRepostory)
    {
        $this->packageRepostory = $packageRepostory;
    }

    public function isHasChanges(PackageEntity $packageEntity): bool
    {
        $vendorDir = realpath(self::VENDOR_DIR);
        $dir = $vendorDir . DIRECTORY_SEPARATOR . $packageEntity->getId();
        $shell = new GitShell($dir);
        $hasChanges = $shell->hasChanges();
        return $hasChanges;
    }

    public function allChanged()
    {
        /** @var PackageEntity[] $packageCollection */
        $packageCollection = $this->packageRepostory->all();
        $changedCollection = new Collection;
        foreach ($packageCollection as $packageEntity) {
            $hasChanges = $this->isHasChanges($packageEntity);
            if ($hasChanges) {
                $changedCollection->add($packageEntity);
            }
        }
        return $changedCollection;
    }

    public function allVersion(PackageEntity $packageEntity)
    {
        $tagCollection = $this->allTag($packageEntity);
        if ($tagCollection->count()) {
            $tags = $tagCollection->map(function (TagEntity $tagEntity) {
                preg_match('/v?(\d+\.\d+\.\d+)/i', $tagEntity->getName(), $matches);
                return $matches[1] ?? null;
            })->toArray();

            /*$tags[] = '0.2.1';
            $tags[] = '0.0.9';
            $tags[] = '0.1.3';*/

            usort($tags, function ($first, $second) {
                if (version_compare($first, $second, '=')) {
                    return 0;
                }
                return version_compare($first, $second, '<') ? 1 : -1;
            });
            $tags = array_values($tags);
            return $tags;
        }
    }

    public function allCommit(PackageEntity $packageEntity): Collection
    {
        $git = new GitShell($packageEntity->getDirectory());
        $commits = $git->getCommits();
        $commitCollection = EntityHelper::createEntityCollection(CommitEntity::class, $commits);
        return $commitCollection;
    }

    public function allTag(PackageEntity $packageEntity): Collection
    {
        $git = new GitShell($packageEntity->getDirectory());
        $tags = $git->getTagsSha();
        $tagCollection = EntityHelper::createEntityCollection(TagEntity::class, $tags);
        return $tagCollection;
    }
}
