<?php

namespace PhpLab\Sandbox\Generator\Domain\Helpers;

use php7extension\yii\helpers\Inflector;
use PhpLab\Sandbox\Generator\Domain\Dto\BuildDto;

class TemplateCodeHelper
{

    public static function generateCrudWebRoutesConfig(BuildDto $buildDto, string $controllerClassName) {
        $tpl = file_get_contents(__DIR__ . '/../Templates/Web/config/routes.yaml');
        $tpl = str_replace('{{moduleName}}', $buildDto->moduleName, $tpl);
        $tpl = str_replace('{{name}}', $buildDto->name, $tpl);
        $tpl = str_replace('{{endpoint}}', $buildDto->endpoint, $tpl);
        $tpl = str_replace('{{controllerClassName}}', $controllerClassName, $tpl);
        return $tpl;
    }

    public static function generateCrudApiRoutesConfig(BuildDto $buildDto, string $controllerClassName) {
        $tpl = file_get_contents(__DIR__ . '/../Templates/Api/config/routes.yaml');
        $tpl = str_replace('{{moduleName}}', $buildDto->moduleName, $tpl);
        $tpl = str_replace('{{name}}', $buildDto->name, $tpl);
        $tpl = str_replace('{{endpoint}}', $buildDto->endpoint, $tpl);
        $tpl = str_replace('{{controllerClassName}}', $controllerClassName, $tpl);
        return $tpl;
    }

    public static function generateMigrationClassCode(string $className, array $attributes, string $tableName = ''): string
    {
        $fieldCode = self::generateAttributes($attributes);
        $code =
            "<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use PhpLab\Eloquent\Migration\Base\BaseCreateTableMigration;

if ( ! class_exists({$className}::class)) {

    class {$className} extends BaseCreateTableMigration
    {

        protected \$tableName = '{$tableName}';
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

    private static function generateAttributes(array $attributes) {
        $fieldCode = '';
        $fields = [];
        $spaces = str_repeat(" ", 4 * 4);
        foreach ($attributes as $attribute) {
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
