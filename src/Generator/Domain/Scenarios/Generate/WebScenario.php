<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios\Generate;

use php7extension\core\code\entities\ClassEntity;
use php7extension\core\code\entities\ClassUseEntity;
use php7extension\core\code\entities\ClassVariableEntity;
use php7extension\core\code\entities\InterfaceEntity;
use php7extension\core\code\enums\AccessEnum;
use php7extension\core\code\helpers\ClassHelper;
use php7extension\yii\helpers\FileHelper;
use PhpLab\Sandbox\Generator\Domain\Enums\TypeEnum;
use PhpLab\Sandbox\Generator\Domain\Helpers\LocationHelper;
use PhpLab\Sandbox\Generator\Domain\Helpers\TemplateCodeHelper;
use PhpLab\Sandbox\Package\Domain\Helpers\PackageHelper;

class WebScenario extends BaseScenario
{

    public function typeName()
    {
        return 'Controller';
    }

    public function classDir()
    {
        return 'Controllers';
    }

    /*protected function createInterface(): InterfaceEntity
    {
        $className = $this->getClassName();
        $uses = [];
        $interfaceEntity = new InterfaceEntity;
        $interfaceEntity->name = $this->getInterfaceFullName($className);
        if ($this->buildDto->isCrudService) {
            $uses[] = new ClassUseEntity(['name' => 'PhpLab\Domain\Interfaces\CrudServiceInterface']);
            $interfaceEntity->extends = 'CrudServiceInterface';
        }
        ClassHelper::generate($interfaceEntity, $uses);
        return $interfaceEntity;
    }*/

    protected function createClass()
    {

        $className = $this->getClassName();
        //dd($className);
        $uses = [];
        $classEntity = new ClassEntity;
        $classFullName = $this->moduleNamespace . '\\' . $this->classDir() . '\\' . $className;
        $classEntity->name = $classFullName;
        if ($this->isMakeInterface()) {
            $useEntity = new ClassUseEntity;
            $useEntity->name = $this->getInterfaceFullName();
            $uses[] = $useEntity;
            $classEntity->implements = $this->getInterfaceName();
        }

        /*$repositoryInterfaceFullClassName = $this->buildDto->moduleNamespace . LocationHelper::fullInterfaceName($this->buildDto->name, TypeEnum::REPOSITORY);
        $repositoryInterfaceClassName = basename($repositoryInterfaceFullClassName);
        $uses[] = new ClassUseEntity(['name' => $repositoryInterfaceFullClassName]);*/

        /*if ($this->buildDto->isCrudController) {
            $uses[] = new ClassUseEntity(['name' => 'PhpLab\Domain\Services\BaseCrudService']);
            $classEntity->extends = 'BaseCrudService';
        } else {
            $uses[] = new ClassUseEntity(['name' => 'PhpLab\Domain\Services\BaseService']);
            $classEntity->extends = 'BaseService';
        }*/
        $uses[] = new ClassUseEntity(['name' => 'Symfony\Bundle\FrameworkBundle\Controller\AbstractController']);
        $uses[] = new ClassUseEntity(['name' => 'PhpLab\Sandbox\Web\Traits\AccessTrait']);
        $classEntity->extends = 'AbstractController';

        $classEntity->uses = [new ClassUseEntity(['name' => 'AccessTrait'])];

        $classEntity->variables = [
            new ClassVariableEntity([
                'name' => 'service',
                'access' => AccessEnum::PRIVATE,
            ]),
        ];

        $classEntity->code = "
    /*public function __construct(ExampleService \$service)
    {
        \$this->service = \$service;
    }*/
";

        ClassHelper::generate($classEntity, $uses);

        $path = PackageHelper::pathByNamespace($this->buildDto->moduleNamespace);
        $routesConfigFile = $path . '/config/routes.yaml';
        FileHelper::save($routesConfigFile, TemplateCodeHelper::generateCrudWebRoutesConfig($this->buildDto, $classFullName));

        return $classEntity;
    }
}
