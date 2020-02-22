<?php

namespace PhpLab\Sandbox\Tests\Unit;

use PhpLab\Sandbox\I18Next\Services\TranslationService;
use PHPUnit\Framework\TestCase;

final class ExampleTest extends TestCase
{

    private $service;

    private function getService() {
        return new TranslationService([
            'test' => 'vendor/php7lab/sandbox/tests/example/',
        ]);
    }

    public function testBasics()
    {
        $service = $this->getService();

        $this->assertEquals('en', $service->getLanguage());

        $this->assertSame('dog', $service->t('test', 'animal.dog'));
        $this->assertSame('A friend', $service->t('test', 'friend'));
        $this->assertSame('1 cat', $service->t('test', 'animal.catWithCount', ['count' => 1]));
    }

    public function testPlural() {
        $service = $this->getService();

        // Simple plural
        $this->assertSame('dogs', $service->t('test', 'animal.dog', ['count' => 2]));
    }

    public function testModifiers() {
        $service = $this->getService();

        // Plural with language override
        $this->assertSame('koiraa', $service->t('test', 'animal.dog', ['count' => 2, 'lng' => 'fi']));

        // Context
        $this->assertSame('A girlfriend', $service->t('test', 'friend', ['context' => 'female']));

        // Context with plural
        $this->assertSame('100 girlfriends', $service->t('test', 'friend', ['context' => 'female', 'count' => 100]));

        // Multiline object
        $this->assertSame(19, count($service->t('test', 'animal.thedoglovers', ['returnObjectTrees' => true])));
    }

}