<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios\Generate;

use php7extension\core\code\entities\ClassVariableEntity;
use php7extension\core\code\entities\DocBlockEntity;
use php7extension\core\code\entities\DocBlockParameterEntity;
use php7extension\core\code\enums\AccessEnum;
use php7extension\yii\helpers\Inflector;
use php7extension\core\code\entities\ClassEntity;
use php7extension\core\code\entities\ClassUseEntity;
use php7extension\core\code\entities\InterfaceEntity;
use php7extension\core\code\helpers\ClassHelper;
use PhpLab\Sandbox\Generator\Domain\Dto\BuildDto;
use PhpLab\Sandbox\Generator\Domain\Enums\TypeEnum;
use PhpLab\Sandbox\Generator\Domain\Helpers\LocationHelper;

class ServiceScenario extends BaseScenario
{

    public function typeName()
    {
        return 'Service';
    }

    public function classDir()
    {
        return 'Services';
    }

    protected function isMakeInterface() : bool {
        return true;
    }

    protected function createInterface() : InterfaceEntity {
        $className = $this->getClassName();
        $uses = [];
        $interfaceEntity = new InterfaceEntity;
        $interfaceEntity->name = $this->getInterfaceFullName($className);
        if($this->buildDto->isCrudService) {
            $uses[] = new ClassUseEntity(['name' => 'PhpLab\Domain\Interfaces\CrudServiceInterface']);
            $interfaceEntity->extends = 'CrudServiceInterface';
        }
        ClassHelper::generate($interfaceEntity, $uses);
        return $interfaceEntity;
    }

    protected function createClass() {
        $className = $this->getClassName();
        $uses = [];
        $classEntity = new ClassEntity;
        $classEntity->name = $this->domainNamespace . '\\' . $this->classDir() . '\\' . $className;
        if($this->isMakeInterface()) {
            $useEntity = new ClassUseEntity;
            $useEntity->name = $this->getInterfaceFullName();
            $uses[] = $useEntity;
            $classEntity->implements = $this->getInterfaceName();
        }

        $repositoryInterfaceFullClassName = $this->buildDto->domainNamespace . LocationHelper::fullInterfaceName($this->name, TypeEnum::REPOSITORY);
        $repositoryInterfaceClassName = basename($repositoryInterfaceFullClassName);
        $uses[] = new ClassUseEntity(['name' => $repositoryInterfaceFullClassName]);

        if($this->buildDto->isCrudService) {
            $uses[] = new ClassUseEntity(['name' => 'PhpLab\Domain\Services\BaseCrudService']);
            $classEntity->extends = 'BaseCrudService';
        } else {
            $uses[] = new ClassUseEntity(['name' => 'PhpLab\Domain\Services\BaseService']);
            $classEntity->extends = 'BaseService';
        }

        $classEntity->code = "
    public function __construct({$repositoryInterfaceClassName} \$repository)
    {
        \$this->repository = \$repository;
    }
";

        ClassHelper::generate($classEntity, $uses);
        return $classEntity;
    }
}
