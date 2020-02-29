<?php

namespace PhpLab\Sandbox\Reference\Repositories\Eloquent;

use PhpLab\Core\Domain\Entities\Query\Where;
use PhpLab\Core\Domain\Libs\Query;
use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use PhpLab\Eloquent\Db\Helpers\Manager;
use PhpLab\Sandbox\I18Next\Interfaces\Services\TranslationServiceInterface;
use PhpLab\Sandbox\Reference\Interfaces\Repositories\ItemTranslationRepositoryInterface;

class ItemTranslationRepository extends BaseEloquentCrudRepository implements ItemTranslationRepositoryInterface
{

    protected $tableName = 'reference_item_translation';

    protected $entityClass = 'PhpLab\\Sandbox\\Reference\\Entities\\ItemTranslationEntity';

    protected $translationService;

    public function __construct(Manager $capsule, TranslationServiceInterface $translationService)
    {
        parent::__construct($capsule);
        $this->translationService = $translationService;
    }

    protected function forgeQuery(Query $query = null)
    {
        $query =  parent::forgeQuery($query);
        $where = new Where('language_code', $this->translationService->getLanguage());
        $query->whereNew($where);
        return $query;
    }
}

