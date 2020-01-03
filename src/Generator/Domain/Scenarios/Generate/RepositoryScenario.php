<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios\Generate;

use php7extension\core\code\entities\ClassVariableEntity;
use php7extension\yii\helpers\Inflector;
use php7extension\core\code\entities\ClassEntity;
use php7extension\core\code\entities\ClassUseEntity;
use php7extension\core\code\entities\InterfaceEntity;
use php7extension\core\code\helpers\ClassHelper;
use PhpLab\Sandbox\Generator\Domain\Dto\BuildDto;

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

    protected function createClass() {
        foreach ($this->buildDto->driver as $driver) {
            $this->createOneClass($driver);
        }
    }

    protected function createOneClass(string $driver) : ClassEntity {
        $className = $this->getClassName();
        $uses = [];
        $classEntity = new ClassEntity;
        $classEntity->name = $this->domainNamespace . '\\' . $this->classDir() . '\\' . $driver . '\\' . $className;
        if($this->isMakeInterface()) {
            $useEntity = new ClassUseEntity;
            $useEntity->name = $this->getInterfaceFullName();
            $uses[] = $useEntity;
            $classEntity->implements = $this->getInterfaceName();
        }

        $entityClassName = Inflector::camelize($this->name) . 'Entity';
        $entityFullClassName = $this->buildDto->domainNamespace . '\\Entities\\' . $entityClassName;
        $uses[] = new ClassUseEntity(['name' => $entityFullClassName]);
        //dd($entityFullClassName);


        $code = "
    protected \$tableName = '';
    protected \$entityClass = {$entityClassName}::class;
";
        $classEntity->code = $code;

        /*if($this->attributes) {
            foreach ($this->attributes as $attribute) {
                $classEntity->addVariable(new ClassVariableEntity([
                    'name' => $attribute,
                ]));
            }
        }*/

        ClassHelper::generate($classEntity, $uses);
        return $classEntity;
    }
}
