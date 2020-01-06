<?php

namespace PhpLab\Sandbox\Generator\Domain\Helpers;

use php7extension\yii\helpers\Inflector;

class TemplateCodeHelper
{

    public static function generateCrudApiRoutesConfig(string $module, string $entity, string $endpoint, string $controllerClassName) {
        $tpl =
"{$module}_{$entity}_index:
    methods: [GET]
    path: /v1/{$endpoint}
    controller: {$controllerClassName}::index

{$module}_{$entity}_create:
    path: /v1/{$endpoint}
    methods: [POST]
    controller: {$controllerClassName}::create

{$module}_{$entity}_view:
    methods: [GET]
    path: /v1/{$endpoint}/{id}
    controller: {$controllerClassName}::view
    requirements:
        id: '\d+'

{$module}_{$entity}_update:
    methods: [PUT]
    path: /v1/{$endpoint}/{id}
    controller: {$controllerClassName}::update
    requirements:
        id: '\d+'

{$module}_{$entity}_delete:
    methods: [DELETE]
    path: /v1/{$endpoint}/{id}
    controller: {$controllerClassName}::delete
    requirements:
        id: '\d+'

{$module}_{$entity}_index_options:
    methods: [OPTIONS]
    path: /v1/{$endpoint}
    controller: {$controllerClassName}::options

{$module}_{$entity}_options:
    methods: [OPTIONS]
    path: /v1/{$endpoint}/{id}
    controller: {$controllerClassName}::options
    requirements:
        id: '\d+'
";
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
