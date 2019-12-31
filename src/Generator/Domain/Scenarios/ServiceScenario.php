<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios;

use php7extension\core\code\entities\ClassEntity;
use php7extension\core\code\entities\ClassUseEntity;
use php7extension\core\code\entities\InterfaceEntity;
use php7extension\core\code\helpers\ClassHelper;
use php7extension\yii\helpers\Inflector;

class ServiceScenario extends BaseScenario
{

    const DIR_NAME = 'Services';
    const TYPE_NAME = 'Service';

    public function run()
    {
        $interfaceEntity = $this->createInterface();
        $this->createClass();
    }

    private function createInterface() : InterfaceEntity {
        $className = $this->getClassName();
        $interfaceEntity = new InterfaceEntity;
        $interfaceEntity->name = $this->getInterfaceFullName($className);
        ClassHelper::generate($interfaceEntity);
        return $interfaceEntity;
    }

    private function createClass() : ClassEntity {
        $className = $this->getClassName();
        $useEntity = new ClassUseEntity;
        $useEntity->name = $this->getInterfaceFullName();
        $uses = [
            $useEntity,
        ];
        $classEntity = new ClassEntity;
        $classEntity->name = $this->domainNamespace . '\\' . self::DIR_NAME . '\\' . $className;
        $classEntity->implements = $this->getInterfaceName();
        ClassHelper::generate($classEntity, $uses);
        return $classEntity;
    }

    private function getClassName() : string {
        return Inflector::classify($this->name) . self::TYPE_NAME;
    }

    private function getInterfaceFullName() : string {
        return $this->domainNamespace . '\\Interfaces\\' . self::DIR_NAME . '\\' . $this->getInterfaceName();
    }

    private function getInterfaceName() : string {
        $className = $this->getClassName();
        return $className . 'Interface';
    }

}
