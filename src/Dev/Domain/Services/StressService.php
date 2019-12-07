<?php

namespace PhpLab\Sandbox\Dev\Domain\Services;

use GuzzleHttp\Client;
use php7extension\core\develop\helpers\Benchmark;
use PhpLab\Domain\Data\Collection;
use function GuzzleHttp\Promise\settle;
use PhpLab\Sandbox\Dev\Domain\Entities\ResultEntity;

class StressService
{

    public function test(Collection $queryCollection, int $ageCount) : ResultEntity
    {
        $totalQueryCount = 0;
        $commonRuntime = 0;
        for ($i = 0; $i < $ageCount; $i++) {
            $commonRuntime += $this->test1($queryCollection);
            $totalQueryCount += count($queryCollection);
        }
        $resultEntity = new ResultEntity;
        $resultEntity->runtime = $commonRuntime;
        $resultEntity->queryCount = $totalQueryCount;
        return $resultEntity;
    }

    public function test1(Collection $queryCollection)
    {
        $client = new Client;
        $options = [
            /*'headers' => [
                'Accept' => 'application/json',
            ],*/
        ];

        $commonRuntime = 0;

        foreach ($queryCollection as $i => $testEntity) {
            $promises = [];
            $promises['query_' . $i] = $client->getAsync($testEntity->url, $options);

            // Дождаться завершения всех запросов. Выдает исключение ConnectException если какой-либо из запросов не выполнен
            //$results = unwrap($promises);

            // Дождемся завершения запросов, даже если некоторые из них завершатся неудачно
            Benchmark::begin('stress_test');
            $results = settle($promises)->wait();
            Benchmark::end('stress_test');
            $runtime = Benchmark::allFlat()['stress_test'];
            $commonRuntime = $commonRuntime + $runtime;
            foreach ($results as $result) {
                if ($result['state'] != 'fulfilled' && $result['reason']['code'] > 500) {
                    throw new \UnexpectedValueException('Error!!!!!!!!!!!!!!!');
                }
            }
        }
        return $commonRuntime;
    }

}
