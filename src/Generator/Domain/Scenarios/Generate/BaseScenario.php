<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios\Generate;

use php7extension\core\code\entities\ClassVariableEntity;
use php7extension\core\code\enums\AccessEnum;
use php7extension\yii\helpers\Inflector;
use php7extension\core\code\entities\ClassEntity;
use php7extension\core\code\entities\ClassUseEntity;
use php7extension\core\code\entities\InterfaceEntity;
use php7extension\core\code\helpers\ClassHelper;
use PhpLab\Sandbox\Generator\Domain\Dto\BuildDto;

abstract class BaseScenario
{

    public $domainNamespace;
    public $name;
    public $attributes;

    /** @var BuildDto */
    public $buildDto;

    abstract public function typeName();
    abstract public function classDir();

    public function init()
    {

    }

    public function run()
    {
        if($this->isMakeInterface()) {
            $this->createInterface();
        }
        $this->createClass();
    }

    protected function isMakeInterface() : bool {
        return false;
    }

    protected function getClassName() : string {
        return Inflector::classify($this->name) . $this->typeName();
    }

    protected function interfaceDir()
    {
        return 'Interfaces\\' . $this->classDir();
    }

    protected function getInterfaceFullName() : string {
        return $this->domainNamespace . '\\' . $this->interfaceDir() . '\\' . $this->getInterfaceName();
    }

    protected function getInterfaceName() : string {
        $className = $this->getClassName();
        return $className . 'Interface';
    }

    protected function createInterface() : InterfaceEntity {
        $className = $this->getClassName();
        $interfaceEntity = new InterfaceEntity;
        $interfaceEntity->name = $this->getInterfaceFullName($className);
        ClassHelper::generate($interfaceEntity);
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

        if($this->attributes) {
            foreach ($this->attributes as $attribute) {
                $variableEntity = new ClassVariableEntity;
                $variableEntity->name = Inflector::variablize($attribute);
                //$variableEntity->access = AccessEnum::PRIVATE;
                $classEntity->addVariable($variableEntity);
            }
        }
        ClassHelper::generate($classEntity, $uses);
        return $classEntity;
    }
}
