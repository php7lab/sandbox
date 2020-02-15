<?php

namespace PhpLab\Sandbox\Dashboard\Domain\Services;

use PhpLab\Core\Exceptions\NotFoundException;
use PhpLab\Core\Helpers\StringHelper;
use PhpLab\Core\Legacy\Yii\Helpers\FileHelper;
use PhpLab\Sandbox\Dashboard\Domain\Interfaces\Services\DocServiceInterface;

class DocService implements DocServiceInterface
{

    private $docFileNameMask;

    public function __construct(string $docFileNameMask = 'docs/api/dist/v{version}.html')
    {
        $this->docFileNameMask = $docFileNameMask;
    }

    public function htmlByVersion($version) {
        $fileName = StringHelper::renderTemplate($this->docFileNameMask, ['version' => $version]);
        $docFileName = FileHelper::path($fileName);
        $htmlContent = @file_get_contents($docFileName);
        if(empty($htmlContent)) {
            throw new NotFoundException("Not found API documentation for version v{$version}!");
        }
        return $htmlContent;
    }

}
