<?php

namespace PhpLab\Sandbox\Reference\Repositories\Eloquent;

use Illuminate\Support\Collection;
use PhpLab\Core\Domain\Enums\RelationEnum;
use PhpLab\Core\Domain\Libs\Query;
use PhpLab\Core\Domain\Libs\Relation\OneToMany;
use PhpLab\Core\Domain\Libs\Relation\OneToOne;
use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use PhpLab\Eloquent\Db\Helpers\Manager;
use PhpLab\Sandbox\Reference\Interfaces\Repositories\ItemRepositoryInterface;

class ItemRepository extends BaseEloquentCrudRepository implements ItemRepositoryInterface
{

    protected $tableName = 'reference_item';

    protected $entityClass = 'PhpLab\\Sandbox\\Reference\\Entities\\ItemEntity';

    protected $translationRepository;

    public function __construct(Manager $capsule, ItemTranslationRepository $translationRepository)
    {
        parent::__construct($capsule);
        $this->translationRepository = $translationRepository;
    }

    protected function forgeQuery(Query $query = null)
    {
        $query =  parent::forgeQuery($query);
        $query->with(['translations']);
        return $query;
    }

    public function relations()
    {
        return [
            'translations' => [
                'type' => RelationEnum::CALLBACK,
                'callback' => function (Collection $collection) {
                    $m2m = new OneToMany;
                    $m2m->selfModel = $this;
                    $m2m->foreignModel = $this->translationRepository;
                    $m2m->selfField = 'itemId';
                    $m2m->foreignContainerField = 'translations';
                    $m2m->run($collection);
                },
            ],


            /*'translation' => [
                'type' => RelationEnum::CALLBACK,
                'callback' => function (Collection $collection) {
                    $m2m = new OneToOne;
                    //$m2m->selfModel = $this;

                    $m2m->foreignModel = $this->translationRepository;
                    $m2m->foreignField = 'itemId';
                    $m2m->foreignContainerField = 'translation';

                    $m2m->run($collection);
                },
            ],*/
        ];
    }
}
