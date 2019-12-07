<?php

namespace PhpLab\Sandbox\Dev\Commands;

use GuzzleHttp\Client;
use php7extension\core\develop\helpers\Benchmark;
use PhpLab\Domain\Data\Collection;
use PhpLab\Sandbox\Dev\Domain\Entities\TestEntity;
use PhpLab\Sandbox\Dev\Domain\Services\StressService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function GuzzleHttp\Promise\settle;

class StressCommand extends Command
{
    protected static $defaultName = 'dev:stress:test';

    protected $stressService;

    public function __construct(?string $name = null, StressService $stressService)
    {
        parent::__construct($name);
        $this->stressService = $stressService;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $output->writeln(['<fg=white># Stress test</>']);

        $queryCount = 10;
        $ageCount = 2;
        $url = 'http://symfony-on-rails.lab/php/v1/article';

        /** @var TestEntity[] $queryCollection */
        $queryCollection = new Collection;

        for ($i = 0; $i < $queryCount; $i++) {
            $testEntity = new TestEntity;
            $testEntity->url = $url;
            $queryCollection->add($testEntity);
        }

        $resultEntity =  $this->stressService->test($queryCollection, $ageCount);

        $output->writeln([
            '',
            '<fg=green>Stress success!</>',
            '<fg=green>Total runtime: ' . $resultEntity->runtime . '</>',
            '<fg=green>Query count: ' . $resultEntity->queryCount . '</>',
            '<fg=green>Query runtime: ' . ($resultEntity->runtime / $resultEntity->queryCount) . '</>',
            '',
        ]);

    }

}
