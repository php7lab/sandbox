<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios\Generate;

use php7extension\yii\helpers\FileHelper;
use php7extension\yii\helpers\Inflector;
use PhpLab\Sandbox\Generator\Domain\Helpers\TemplateCodeHelper;
use PhpLab\Sandbox\Package\Domain\Helpers\PackageHelper;
use function Symfony\Component\Debug\Tests\testHeader;

class MigrationScenario extends BaseScenario
{

    public function typeName()
    {
        return 'Migration';
    }

    public function classDir()
    {
        return 'Migrations';
    }

    protected function getClassName(): string
    {
        $timeStr = date('Y_m_d_His');
        $className = "m_{$timeStr}_create_{$this->name}_table";
        return $className;
    }

    protected function createClass()
    {
        $fileName = $this->getFileName();
        $tableName = $this->buildDto->domainName . '_' . $this->buildDto->name;
        $code = TemplateCodeHelper::generateMigrationClassCode($this->getClassName(), $this->buildDto->attributes, $tableName);
        FileHelper::save($fileName, $code);
    }

    private function getFileName()
    {
        $className = $this->getClassName();
        $dir = PackageHelper::pathByNamespace($this->buildDto->domainNamespace . '/' . $this->classDir());
        $fileName = $dir . '/' . $className . '.php';
        return $fileName;
    }

}
