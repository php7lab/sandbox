<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\helpers;

use Illuminate\Support\Collection;
use PhpLab\Sandbox\RestClient\Domain\Entities\BookmarkEntity;
use yii2rails\extension\yii\helpers\ArrayHelper;

class CollectionHelper {

    /**
     * @param Collection | BookmarkEntity[] $collection
     * @return array
     */
	public static function prependCollection(Collection $collection) {
		$closure = function (BookmarkEntity $row) {
			if (preg_match('|[^/]+|', ltrim($row->getUri(), '/'), $m)) {
				return $m[0];
			} else {
				return 'common';
			}
		};
		$collection = ArrayHelper::group($collection, $closure);
        return $collection;
	}
	
	
	
}