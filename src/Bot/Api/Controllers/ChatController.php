<?php

namespace PhpLab\Sandbox\Bot\Api\Controllers;

use PhpLab\Domain\Exceptions\UnprocessibleEntityException;
use PhpLab\Rest\Base\BaseCrudApiController;
use PhpLab\Rest\Libs\JsonRestSerializer;
use PhpLab\Sandbox\Messenger\Domain\Interfaces\ChatServiceInterface;
use PhpLab\Sandbox\Web\Enums\HttpHeaderEnum;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use PhpLab\Sandbox\Messenger\Domain\Libs\WordClassificator;
use Phpml\Classification\KNearestNeighbors;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ChatController
{

    /*public function __construct(ChatServiceInterface $chatService)
    {
        $this->service = $chatService;
    }*/

    public function send(Request $request): JsonResponse
    {
        $response = new JsonResponse;
        $body = $request->request->all();

        $userMessage = $body['content'];


        $wordClassificator = new WordClassificator;
        $wantLen = 40;
        $wordClassificator->setWordLength($wantLen);
        $classifier = new KNearestNeighbors;
        $wordClassificator->setClassifier($classifier);
        $wordDictonary = $this->getWords();

        $wordArray = array_keys($wordDictonary);

        //$response->setData($wordArray);
        $wordClassificator->train($wordArray);

        $predict = $wordClassificator->predict($userMessage);
        $response->setData($predict);

        //$this->dialog($wordClassificator, $input, $output);


        try {
            //$entity = $this->service->create($body);
            //$response->setStatusCode(Response::HTTP_CREATED);
            //$response->headers->set(HttpHeaderEnum::X_ENTITY_ID, $entity->getId());
            //$response->setData($words);
        } catch (UnprocessibleEntityException $e) {
            $errorCollection = $e->getErrorCollection();
            $serializer = new JsonRestSerializer($response);
            $serializer->serialize($errorCollection);
            $response->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //$location = $this->generateUrl('app_crud_view', ['id', 3], UrlGeneratorInterface::ABSOLUTE_URL);
        //$response->headers->set('Location', $location);
        return $response;
    }

    private function getWords()
    {
        $content = file_get_contents('C:\Users\Admin\Desktop\answer_databse\answer_databse\answer_databse.txt');
        $content = str_replace("\r\n", PHP_EOL, $content);
//$lineArray = explode(PHP_EOL, $content);
        $lineArray = \PhpLab\Sandbox\Common\Helpers\StringHelper::textToLines($content);
        $rrrrr = [];

        foreach ($lineArray as &$line) {
            $line111 = explode('\\', $line);
            if(isset($line111[1])) {
                $request = \PhpLab\Sandbox\Bot\Domain\Helpers\MlHelper::prepareWord($line111[0]);
                $rrrrr[$request][] = $line111[1];
            }
        }
        return array_slice($rrrrr, 0, 200);
        dd(array_slice($rrrrr, 0, 200));

        $rrr = \php7extension\yii\helpers\ArrayHelper::getColumn($lineArray, 'request');
        foreach ($rrr as &$line) {
            $line = \PhpLab\Sandbox\Bot\Domain\Helpers\MlHelper::prepareWord($line);
        }
        $rrr = array_unique($rrr);
//dd($rrr);

        dd(array_slice($rrr, 0, 200));

        return array_slice($lineArray, 0, 20);
    }

    private function dialog(WordClassificator $wordClassificator, InputInterface $input, OutputInterface $output)
    {
        /*$question = new Question('> ', '');
        $userAnwer = $this->getHelper('question')->ask($input, $output, $question);*/
        $userAnwer = 'как дел';
        $predict = $wordClassificator->predict($userAnwer);
        $output->writeln($predict);
    }

    private function train(WordClassificator $wordClassificator, KNearestNeighbors $classifier): KNearestNeighbors
    {
        $wordCollection = include(__DIR__ . '/../Resources/data/bot_words.php');
        $arr = $wordClassificator->generateTrain($wordCollection, 2);
        list($samples, $labels) = $wordClassificator->prepareSamplesForTraining($arr);
        $classifier->train($samples, $labels);
        return $classifier;
    }

    private function test(WordClassificator $wordClassificator)
    {
        $tests = [
            [
                'sample' => 'как дела',
                'expected' => 'как дела',
            ],
            [
                'sample' => 'как дел',
                'expected' => 'как дела',
            ],
            [
                'sample' => 'как дила',
                'expected' => 'как дела',
            ],
            [
                'sample' => 'каг дила',
                'expected' => 'как дела',
            ],
            [
                'sample' => 'каг дилы',
                'expected' => 'как дела',
            ],

            [
                'sample' => 'привет',
                'expected' => 'привет',
            ],
            [
                'sample' => 'превет',
                'expected' => 'привет',
            ],
            [
                'sample' => 'превед',
                'expected' => 'привет',
            ],
            [
                'sample' => 'привед',
                'expected' => 'привет',
            ],
            /*[
                'sample' => 'првет',
                'expected' => 'привет',
            ],*/

            [
                'sample' => 'да',
                'expected' => 'да',
            ],
            [
                'sample' => 'дп',
                'expected' => 'да',
            ],

            [
                'sample' => 'нет',
                'expected' => 'нет',
            ],
            [
                'sample' => 'нпт',
                'expected' => 'нет',
            ],
            [
                'sample' => 'нее',
                'expected' => 'нет',
            ],

        ];

        $testResults = [];
        foreach ($tests as $test) {
            $predict = $wordClassificator->predict($test['sample']);
            $isOk = $predict == $test['expected'];
            $testResults[] = $isOk;
            if ( ! $isOk) {
                dump("{$test['sample']} - {$test['expected']} - {$predict}");
            }
        }
        dd($testResults);
    }

}
