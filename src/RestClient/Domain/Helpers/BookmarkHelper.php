<?php

namespace PhpLab\Sandbox\RestClient\Domain\Helpers;

use PhpLab\Bundle\Crypt\Enums\HashAlgoEnum;
use PhpLab\Bundle\Crypt\Helpers\SafeBase64Helper;
use PhpLab\Sandbox\RestClient\Domain\Entities\BookmarkEntity;

class BookmarkHelper
{

    public static function generateHash(BookmarkEntity $bookmarkEntity) {
        $scope =
            $bookmarkEntity->getProjectId() . '.' .
            $bookmarkEntity->getMethod() . '.' .
            $bookmarkEntity->getUri() . '.' .
            json_encode($bookmarkEntity->getQuery()) . '.' .
            json_encode($bookmarkEntity->getBody()) . '.' .
            json_encode($bookmarkEntity->getHeader()) . '.' .
            $bookmarkEntity->getAuthorization();
        $hash = hash(HashAlgoEnum::SHA1, $scope, true);
        $base64 = SafeBase64Helper::encode($hash);
        return $base64;
    }

}

