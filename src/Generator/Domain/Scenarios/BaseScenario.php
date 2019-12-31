<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios;

use php7extension\yii\helpers\Inflector;
use php7extension\core\code\entities\ClassEntity;
use php7extension\core\code\entities\ClassUseEntity;
use php7extension\core\code\entities\InterfaceEntity;
use php7extension\core\code\helpers\ClassHelper;

abstract class BaseScenario
{

    public $domainNamespace;
    public $name;

    abstract public function typeName();
    abstract public function classDir();
    //abstract public function interfaceDir();

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

    protected function createClass() : ClassEntity {
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
        ClassHelper::generate($classEntity, $uses);
        return $classEntity;
    }
}
