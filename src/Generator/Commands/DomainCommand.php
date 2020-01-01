<?php

namespace PhpLab\Sandbox\Generator\Commands;

use PhpLab\Sandbox\Generator\Domain\Dto\BuildDto;
use PhpLab\Sandbox\Generator\Domain\Interfaces\DomainServiceInterface;
use Symfony\Component\Console\Command\Command;
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

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $buildDto = new BuildDto;

        $buildDto->typeArray = ['service', 'repository', 'entity'];

        $this->inputDomainNamespace($input, $output, $buildDto);
        $this->inputType($input, $output, $buildDto);
        $this->inputName($input, $output, $buildDto);
        $this->inputDriver($input, $output, $buildDto);

        //dd($buildDto);

        $this->domainService->generate($buildDto);
    }

    private function inputDomainNamespace(InputInterface $input, OutputInterface $output, BuildDto $buildDto)
    {
        $domainQuestion = new Question('Enter domain namespace: ');
        //$buildDto->domainNamespace = $helper->ask($input, $output, $domainQuestion);
        $buildDto->domainNamespace = 'PhpLab\Sandbox\Queue111\Domain';
    }

    private function inputDriver(InputInterface $input, OutputInterface $output, BuildDto $buildDto)
    {
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'Please select your favorite color (defaults to red)',
            ['eloquent', 'file'],
            0
        );
        $question->setMultiselect(true);

        //$buildDto->driver = $helper->ask($input, $output, $question);
        $buildDto->driver = 'eloquentttttt';
    }

    private function inputName(InputInterface $input, OutputInterface $output, BuildDto $buildDto)
    {
        $helper = $this->getHelper('question');
        $question = new Question('Enter unit name: ');
        //$buildDto->name = $helper->ask($input, $output, $question);
        $buildDto->name = 'qwerty';
    }

    private function inputType(InputInterface $input, OutputInterface $output, BuildDto $buildDto)
    {
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'Please select your favorite color (defaults to red)',
            $buildDto->typeArray,
            0
        );
        $question->setMultiselect(true);
        //$buildDto->types = $helper->ask($input, $output, $question);
        $buildDto->types = $buildDto->typeArray;
    }

}
