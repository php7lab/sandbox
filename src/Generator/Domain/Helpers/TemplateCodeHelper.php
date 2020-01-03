<?php

namespace PhpLab\Sandbox\Generator\Domain\Helpers;

use php7extension\yii\helpers\Inflector;

class TemplateCodeHelper
{

    public static function generateMigrationClassCode(string $className, array $attributes): string
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
