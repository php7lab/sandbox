<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios\Generate;

use php7extension\core\code\entities\ClassVariableEntity;
use php7extension\core\code\helpers\CodeHelper;
use php7extension\yii\helpers\FileHelper;
use php7extension\yii\helpers\Inflector;
use php7extension\core\code\entities\ClassEntity;
use php7extension\core\code\entities\ClassUseEntity;
use php7extension\core\code\entities\InterfaceEntity;
use php7extension\core\code\helpers\ClassHelper;
use PhpLab\Sandbox\Generator\Domain\Dto\BuildDto;
use PhpLab\Sandbox\Package\Domain\Helpers\PackageHelper;

use php7rails\domain\BaseEntity;
use php7rails\domain\helpers\Helper;
use php7extension\core\code\entities\CodeEntity;
use php7extension\core\code\render\ClassRender;
use php7extension\core\code\render\InterfaceRender;
use php7extension\yii\helpers\ArrayHelper;

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

    protected function createClass() {

        $fileName = $this->getFileName();
        $code = $this->generateCode();
        FileHelper::save($fileName, $code);
    }

    private function getFileName() {
        $className = $this->getClassName();
        $dir = PackageHelper::pathByNamespace($this->buildDto->domainNamespace . '/' . $this->classDir());
        $fileName = $dir . '/' . $className . '.php';
        return $fileName;
    }

    private function generateCode() : string {
        $className = $this->getClassName();
        $fieldCode = '';
        foreach ($this->buildDto->attributes as $attribute) {
            if($attribute == 'id') {
                $fieldCode .= "\t\t\t\t\$table->integer('id')->autoIncrement();" . PHP_EOL;
            } elseif(strpos($attribute, '_at') == strlen($attribute) - 3) {
                $fieldCode .= "\t\t\t\t\$table->dateTime('{$attribute}')->comment('');" . PHP_EOL;
            } elseif(strpos($attribute, 'is_') === 0) {
                $fieldCode .= "\t\t\t\t\$table->boolean('{$attribute}')->comment('');" . PHP_EOL;
            } else {
                $fieldCode .= "\t\t\t\t\$table->string('{$attribute}')->comment('');" . PHP_EOL;
            }
        }
        $fieldCode = rtrim($fieldCode);

        $code =
            "<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use PhpLab\Eloquent\Migration\Base\BaseCreateTableMigration;

if ( ! class_exists({$className}::class)) {

    class {$className} extends BaseCreateTableMigration
    {

        protected \$tableName = '{$this->name}';
        protected \$tableComment = '{$this->name}';

        public function tableSchema()
        {
            return function (Blueprint \$table) {
{$fieldCode}
            };
        }

    }

}";
        return $code;
    }
}
