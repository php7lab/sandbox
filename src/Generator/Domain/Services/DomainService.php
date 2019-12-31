<?php

namespace PhpLab\Sandbox\Generator\Domain\Services;

use PhpLab\Sandbox\Generator\Domain\Interfaces\DomainServiceInterface;

class DomainService implements DomainServiceInterface
{

    public function generateService($domainNamespace, $name)
    {
        $serviceClassName = Inflector::classify($name) . 'Service';

        $serviceInterfaceClass = new InterfaceEntity;
        $serviceInterfaceClass->name = $domainNamespace . '\\Interfaces\\Services\\' . $serviceClassName . 'Interface';
        ClassHelper::generate($serviceInterfaceClass);

        $useServiceInterface = new ClassUseEntity;
        $useServiceInterface->name = $domainNamespace . '\\Interfaces\\Services\\' . $serviceClassName . 'Interface';

        $uses = [
            $useServiceInterface,
        ];

        $serviceClass = new ClassEntity;
        $serviceClass->name = $domainNamespace . '\\Services\\' . $serviceClassName;
        /*$serviceClass->uses = [
            $useServiceInterface
        ];*/
        $serviceClass->implements = Inflector::classify($name) . 'ServiceInterface';
        ClassHelper::generate($serviceClass, $uses);
    }

}
