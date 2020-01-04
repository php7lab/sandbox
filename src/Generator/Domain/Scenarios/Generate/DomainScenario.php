<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios\Generate;

use php7extension\core\code\entities\ClassEntity;
use php7extension\core\code\entities\ClassUseEntity;
use php7extension\core\code\helpers\ClassHelper;
use PhpLab\Sandbox\Generator\Domain\Enums\TypeEnum;
use PhpLab\Sandbox\Generator\Domain\Helpers\LocationHelper;

class DomainScenario extends BaseScenario
{

    public function typeName()
    {
        return 'Domain';
    }

    public function classDir()
    {
        return '';
    }

    protected function createClass()
    {
        $className = $this->getClassName();
        $uses = [];
        $classEntity = new ClassEntity;
        $classEntity->name = $this->domainNamespace . '\\Domain';

        $uses[] = new ClassUseEntity(['name' => 'PhpLab\Domain\Interfaces\DomainInterface']);
        $classEntity->implements = 'DomainInterface';

        $classEntity->code = "
    public function getName()
    {
        return '{$this->buildDto->domainName}';
    }
";

        ClassHelper::generate($classEntity, $uses);
        return $classEntity;
    }
}
