<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios\Generate;

use php7extension\core\code\entities\ClassVariableEntity;
use php7extension\yii\helpers\Inflector;
use php7extension\core\code\entities\ClassEntity;
use php7extension\core\code\entities\ClassUseEntity;
use php7extension\core\code\entities\InterfaceEntity;
use php7extension\core\code\helpers\ClassHelper;
use PhpLab\Sandbox\Generator\Domain\Dto\BuildDto;
use PhpLab\Sandbox\Generator\Domain\Enums\TypeEnum;
use PhpLab\Sandbox\Generator\Domain\Helpers\LocationHelper;

class RepositoryScenario extends BaseScenario
{

    public $driver;

    public function typeName()
    {
        return 'Repository';
    }

    public function classDir()
    {
        return 'Repositories';
    }

    protected function isMakeInterface() : bool {
        return true;
    }

    protected function createInterface() : InterfaceEntity {
        $className = $this->getClassName();
        $interfaceEntity = new InterfaceEntity;
        $interfaceEntity->name = $this->getInterfaceFullName($className);
        if($this->buildDto->isCrudRepository) {
            $uses[] = new ClassUseEntity(['name' => 'PhpLab\Domain\Interfaces\CrudRepositoryInterface']);
            $interfaceEntity->extends = 'CrudRepositoryInterface';
        }
        ClassHelper::generate($interfaceEntity, $uses);
        return $interfaceEntity;
    }

    protected function createClass() {
        foreach ($this->buildDto->driver as $driver) {
            $this->createOneClass($driver);
        }
    }

    protected function createOneClass(string $driver) : ClassEntity {
        $className = $this->getClassName();
        $uses = [];
        $classEntity = new ClassEntity;
        $classEntity->name = $this->domainNamespace . '\\' . $this->classDir() . '\\' . Inflector::camelize($driver) . '\\' . $className;
        if($this->isMakeInterface()) {
            $useEntity = new ClassUseEntity;
            $useEntity->name = $this->getInterfaceFullName();
            $uses[] = $useEntity;
            $classEntity->implements = $this->getInterfaceName();
        }

        $entityFullClassName = $this->domainNamespace . LocationHelper::fullClassName($this->name, TypeEnum::ENTITY);
        $entityClassName = basename($entityFullClassName);
        $uses[] = new ClassUseEntity(['name' => $entityFullClassName]);

        $parentClass = $this->parentClass($driver);
        $uses[] = new ClassUseEntity(['name' => $parentClass]);
        $classEntity->extends = basename($parentClass);

        $classEntity->code = "
    protected \$tableName = '';
    protected \$entityClass = {$entityClassName}::class;
";

        ClassHelper::generate($classEntity, $uses);
        return $classEntity;
    }

    private function parentClass($driver) {
        $className = '';
        if('eloquent' == $driver) {
            if($this->buildDto->isCrudRepository) {
                $className = 'PhpLab\Eloquent\Db\Repositories\BaseEloquentCrudRepository';
            } else {
                $className = 'PhpLab\Eloquent\Db\Repositories\BaseEloquentRepository';
            }
        } else {
            $className = 'PhpLab\Domain\Repositories\BaseRepository';
        }
        return $className;
    }

}
