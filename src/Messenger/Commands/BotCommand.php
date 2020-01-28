<?php

namespace PhpLab\Sandbox\Messenger\Commands;

use PhpLab\Sandbox\Messenger\Domain\Libs\WordClassificator;
use Phpml\Classification\KNearestNeighbors;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class BotCommand extends Command
{

    protected static $defaultName = 'messenger:bot';
    private $domainService;

    /*public function __construct(?string $name = null, DomainServiceInterface $domainService)
    {
        parent::__construct($name);
        $this->domainService = $domainService;
    }*/

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<fg=white># Привет, я Бот!</>');

        $wordClassificator = new WordClassificator;
        $wantLen = 20;
        $wordClassificator->setWordLength($wantLen);
        $classifier = new KNearestNeighbors;
        $wordClassificator->setClassifier($classifier);
        $wordCollection = include(__DIR__ . '/../Resources/data/bot_words.php');
        $wordClassificator->train($wordCollection);

        /*$question = new Question('> ', '');
        $userAnwer = $this->getHelper('question')->ask($input, $output, $question);*/
        $userAnwer = 'как дел';

        $predict = $wordClassificator->predict($userAnwer);
        $output->writeln($predict);
    }

    private function train(WordClassificator $wordClassificator, KNearestNeighbors $classifier) : KNearestNeighbors {
        $wordCollection = include(__DIR__ . '/../Resources/data/bot_words.php');
        $arr = $wordClassificator->generateTrain($wordCollection, 2);
        list($samples, $labels) = $wordClassificator->prepareSamplesForTraining($arr);
        $classifier->train($samples, $labels);
        return $classifier;
    }

}
