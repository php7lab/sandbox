<?php

namespace PhpLab\Sandbox\Generator\Commands;

use php7extension\core\code\entities\ClassEntity;
use php7extension\core\code\entities\ClassUseEntity;
use php7extension\core\code\entities\InterfaceEntity;
use php7extension\core\code\helpers\ClassHelper;
use php7extension\yii\helpers\Inflector;
use PhpLab\Sandbox\Generator\Domain\Interfaces\DomainServiceInterface;
use PhpLab\Sandbox\Generator\Domain\Scenarios\BaseScenario;
use PhpLab\Sandbox\Generator\Domain\Scenarios\ServiceScenario;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

class DomainCommand extends Command
{

    protected static $defaultName = 'generator:domain';
    private $domainService;

    public function __construct(?string $name = null, DomainServiceInterface $domainService)
    {
        parent::__construct($name);
        $this->domainService = $domainService;
    }

    protected function configure()
    {
        /*$this
            ->addArgument('name', InputArgument::REQUIRED, 'Who do you want to greet?')
        ;*/
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');

        $domainQuestion = new Question('Enter domain namespace: ');
        //$domainNamespace = $helper->ask($input, $output, $domainQuestion);
        $domainNamespace = 'PhpLab\Sandbox\Queue111\Domain';

        $typeArray = ['service', 'repository', 'entity'];
        $typeQuestion = new ChoiceQuestion(
            'Please select your favorite color (defaults to red)',
            $typeArray,
            0
        );
        $typeQuestion->setMultiselect(true);
        //$types = $helper->ask($input, $output, $typeQuestion);
        $types = [0];

        $nameQuestion = new Question('Enter unit name: ');
        //$name = $helper->ask($input, $output, $domainQuestion);
        $name = 'qwerty';

        foreach ($types as $typeIndex) {
            $type = $typeArray[$typeIndex];
            $type = Inflector::classify($type);
            $scenarioClass = 'PhpLab\\Sandbox\\Generator\\Domain\Scenarios\\' . $type . 'Scenario';
            /** @var BaseScenario $scenarioInstance */
            $scenarioInstance = new $scenarioClass;
            $scenarioInstance->name = $name;
            $scenarioInstance->domainNamespace = $domainNamespace;
            $scenarioInstance->run();
            //dd($scenarioInstance);
        }

        /*if(in_array('service', $types)) {
            $this->domainService->generateService($domainNamespace, $name);
        }*/

    }

}
