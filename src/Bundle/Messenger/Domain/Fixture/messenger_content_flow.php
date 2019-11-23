<?php

use PhpLab\Eloquent\Fixture\Helper\FixtureFactoryHelper;

$fixture = new FixtureFactoryHelper;
$fixture->setCount(300);
$fixture->setCallback(function ($index, FixtureFactoryHelper $fixtureFactory) {
    return [
        'id' => $index,
        'content_id' => $index,
        'chat_id' => $fixtureFactory->ordIndex($index, 3),
    ];
});
return $fixture->generateCollection();
