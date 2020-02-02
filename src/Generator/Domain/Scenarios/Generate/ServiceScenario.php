<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios\Generate;

use php7extension\core\code\entities\ClassEntity;
use php7extension\core\code\entities\ClassUseEntity;
use php7extension\core\code\entities\ClassVariableEntity;
use php7extension\core\code\entities\DocBlockEntity;
use php7extension\core\code\entities\DocBlockParameterEntity;
use php7extension\core\code\entities\InterfaceEntity;
use php7extension\core\code\enums\AccessEnum;
use php7extension\core\code\helpers\ClassHelper;
use php7extension\yii\helpers\Inflector;
use PhpLab\Sandbox\Generator\Domain\Enums\TypeEnum;
use PhpLab\Sandbox\Generator\Domain\Helpers\LocationHelper;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\FileGenerator;
use Zend\Code\Generator\InterfaceGenerator;
use Zend\Code\Generator\MethodGenerator;
use Zend\Code\Generator\ParameterGenerator;

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

    protected function isMakeInterface(): bool
    {
        return true;
    }

    protected function createInterface()
    {
        $fileGenerator = new FileGenerator;
        $interfaceGenerator = new InterfaceGenerator;
        $interfaceGenerator->setName($this->getInterfaceName());
        if ($this->buildDto->isCrudService) {
            $fileGenerator->setUse('PhpLab\Core\Domain\Interfaces\Service\CrudServiceInterface');
            $interfaceGenerator->setImplementedInterfaces(['CrudServiceInterface']);
        }
        $fileGenerator->setNamespace($this->domainNamespace . '\\' . $this->interfaceDir());
        $fileGenerator->setClass($interfaceGenerator);
        ClassHelper::generateFile($fileGenerator->getNamespace() . '\\' . $this->getInterfaceName(), $fileGenerator->generate());


        /*$className = $this->getClassName();
        $uses = [];
        $interfaceEntity = new InterfaceEntity;
        $interfaceEntity->name = $this->getInterfaceFullName($className);
        if($this->buildDto->isCrudService) {
            $uses[] = new ClassUseEntity(['name' => 'PhpLab\Core\Domain\Interfaces\Service\CrudServiceInterface']);
            $interfaceEntity->extends = 'CrudServiceInterface';
        }
        ClassHelper::generate($interfaceEntity, $uses);
        return $interfaceEntity;*/
    }

    protected function createClass()
    {
        $className = $this->getClassName();
        $fullClassName = $this->getFullClassName();
        $fileGenerator = new FileGenerator;
        $classGenerator = new ClassGenerator;
        $classGenerator->setName($className);
        if ($this->isMakeInterface()) {
            $classGenerator->setImplementedInterfaces([$this->getInterfaceName()]);
            $fileGenerator->setUse($this->getInterfaceFullName());
        }

        $repositoryInterfaceFullClassName = $this->buildDto->domainNamespace . LocationHelper::fullInterfaceName($this->name, TypeEnum::REPOSITORY);
        //$repositoryInterfaceClassName = basename($repositoryInterfaceFullClassName);
        //$fileGenerator->setUse($repositoryInterfaceFullClassName);

        if ($this->attributes) {
            foreach ($this->attributes as $attribute) {
                $classGenerator->addProperties([
                    [Inflector::variablize($attribute)]
                ]);
            }
        }
        $fileGenerator->setNamespace($this->domainNamespace . '\\' . $this->classDir());
        $fileGenerator->setClass($classGenerator);


        if ($this->buildDto->isCrudService) {
            $fileGenerator->setUse('PhpLab\Core\Domain\Base\BaseCrudService');
            $classGenerator->setExtendedClass('BaseCrudService');
        } else {
            $fileGenerator->setUse('PhpLab\Core\Domain\Base\BaseService');
            $classGenerator->setExtendedClass('BaseService');
        }

        $parameterGenerator = new ParameterGenerator;
        $parameterGenerator->setName('repository');
        $parameterGenerator->setType($repositoryInterfaceFullClassName);

        $methodGenerator = new MethodGenerator;
        $methodGenerator->setName('__construct');
        $methodGenerator->setParameter($parameterGenerator);
        $methodGenerator->setBody('$this->repository = $repository;');

        $classGenerator->addMethods([$methodGenerator]);

        /*$code = "
    public function __construct({$repositoryInterfaceClassName} \$repository)
    {
        \$this->repository = \$repository;
    }
";*/

        ClassHelper::generateFile($fileGenerator->getNamespace() . '\\' . $className, $fileGenerator->generate());


        /*$className = $this->getClassName();
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
            $uses[] = new ClassUseEntity(['name' => 'PhpLab\Core\Domain\Base\BaseCrudService']);
            $classEntity->extends = 'BaseCrudService';
        } else {
            $uses[] = new ClassUseEntity(['name' => 'PhpLab\Core\Domain\Base\BaseService']);
            $classEntity->extends = 'BaseService';
        }

        $classEntity->code = "
    public function __construct({$repositoryInterfaceClassName} \$repository)
    {
        \$this->repository = \$repository;
    }
";

        ClassHelper::generate($classEntity, $uses);
        return $classEntity;*/
    }
}
