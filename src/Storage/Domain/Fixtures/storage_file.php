<?php

use PhpLab\Eloquent\Fixture\Helpers\FixtureFactoryHelper;
use PhpLab\Bundle\Crypt\Enums\HashAlgoEnum;

$fixture = new FixtureFactoryHelper;
$fixture->setCount(200);
$fixture->setCallback(function ($index, FixtureFactoryHelper $fixtureFactory) {
    return [
        'id' => $index,
        'service_id' => $fixtureFactory->ordIndex($index, 2),
        'entity_id' => $fixtureFactory->ordIndex($index, 7),
        'author_id' => $fixtureFactory->ordIndex($index, 10),
        'hash' => hash(HashAlgoEnum::CRC32B, $index),
        'extension' => $fixtureFactory->ordIndex($index, 2) == 1 ? 'png' : 'jpg',
        'size' => 10000,
        'name' => 'file ' . $index,
        'description' => 'file ' . $index . ' description',
        'status' => 1,
        'created_at' => '2020-02-09 21:54:25',
        'updated_at' => '2020-02-09 21:54:25',
    ];
});
return $fixture->generateCollection();
