<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios\Generate;

use php7extension\yii\helpers\FileHelper;
use php7extension\yii\helpers\Inflector;
use PhpLab\Sandbox\Package\Domain\Helpers\PackageHelper;

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
        $code = $this->generateCode();
        FileHelper::save($fileName, $code);
    }

    private function getFileName()
    {
        $className = $this->getClassName();
        $dir = PackageHelper::pathByNamespace($this->buildDto->domainNamespace . '/' . $this->classDir());
        $fileName = $dir . '/' . $className . '.php';
        return $fileName;
    }

    private function generateCode(): string
    {
        $className = $this->getClassName();
        $fieldCode = $this->generateAttributes();
        $code =
            "<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use PhpLab\Eloquent\Migration\Base\BaseCreateTableMigration;

if ( ! class_exists({$className}::class)) {

    class {$className} extends BaseCreateTableMigration
    {

        protected \$tableName = '';
        protected \$tableComment = '';

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

    private function generateAttributes() {
        $fieldCode = '';
        $fields = [];
        $spaces = str_repeat(" ", 4 * 4);
        foreach ($this->buildDto->attributes as $attribute) {
            $attribute = Inflector::underscore($attribute);
            if ($attribute == 'id') {
                $fields[] = "$spaces\$table->integer('id')->autoIncrement();";
            } elseif (strpos($attribute, '_at') == strlen($attribute) - 3) {
                $fields[] = "$spaces\$table->dateTime('{$attribute}')->comment('');";
            } elseif (strpos($attribute, 'is_') === 0) {
                $fields[] = "$spaces\$table->boolean('{$attribute}')->comment('');";
            } else {
                $fields[] = "$spaces\$table->string('{$attribute}')->comment('');";
            }
        }
        $fieldCode = implode(PHP_EOL, $fields);
        return $fieldCode;
    }
}
