<?php

namespace PhpLab\Sandbox\Generator\Commands;

use PhpLab\Sandbox\Generator\Domain\Dto\BuildDto;
use PhpLab\Sandbox\Generator\Domain\Interfaces\DomainServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\ConfirmationQuestion;
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
        $this->input($input, $output, $buildDto);

        dd($buildDto);

        $this->domainService->generate($buildDto);
    }

    private function input(InputInterface $input, OutputInterface $output, BuildDto $buildDto)
    {
        $this->inputDomainNamespace($input, $output, $buildDto);
        $this->inputType($input, $output, $buildDto);
        $this->inputName($input, $output, $buildDto);

        $typesFlip = array_flip($buildDto->typeArray);

        if(in_array($typesFlip['entity'], $buildDto->types)) {
            $this->inputEntityAttributes($input, $output, $buildDto);
        }

        if(in_array($typesFlip['service'], $buildDto->types)) {
            $this->inputIsCrudService($input, $output, $buildDto);
        }

        if(in_array($typesFlip['repository'], $buildDto->types)) {
            $this->inputIsCrudRepository($input, $output, $buildDto);
            $this->inputDriver($input, $output, $buildDto);
        }
    }

    private function inputIsCrudService(InputInterface $input, OutputInterface $output, BuildDto $buildDto)
    {
        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion(
            'Is CRUD service? (y|n): ',
            false
        );

        //$buildDto->idCrudService = $helper->ask($input, $output, $question);
        $buildDto->idCrudService = false;
    }

    private function inputIsCrudRepository(InputInterface $input, OutputInterface $output, BuildDto $buildDto)
    {
        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion(
            'Is CRUD repository? (y|n): ',
            false
        );

        //$buildDto->idCrudRepository = $helper->ask($input, $output, $question);
        $buildDto->idCrudRepository = false;
    }

    private function inputDomainNamespace(InputInterface $input, OutputInterface $output, BuildDto $buildDto)
    {
        $helper = $this->getHelper('question');
        $question = new Question('Enter domain namespace: ');
        //$buildDto->domainNamespace = $helper->ask($input, $output, $question);
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

    private function inputEntityAttributes(InputInterface $input, OutputInterface $output, BuildDto $buildDto)
    {
        $helper = $this->getHelper('question');
        $question = new Question('Enter entity attribute: ');
        do {
            $attribute = $helper->ask($input, $output, $question);
            $attribute = trim($attribute);
            if($attribute) {
                $buildDto->attributes[] = $attribute;
            }
        } while( ! empty($attribute));
        //$buildDto->name = 'qwerty';
    }

    private function inputType(InputInterface $input, OutputInterface $output, BuildDto $buildDto)
    {
        $helper = $this->getHelper('question');
        $typeArray = $buildDto->typeArray;
        $typeArray['a'] = 'all';
        $question = new ChoiceQuestion(
            'Select types',
            $typeArray
        );
        $question->setMultiselect(true);
        $buildDto->types = $helper->ask($input, $output, $question);
        //$buildDto->types = ['a'];
        if(in_array('a', $buildDto->types)) {
            $buildDto->types = array_keys($buildDto->typeArray);
        }
        $buildDto->types = array_map(function ($item) {
            return intval($item);
        }, $buildDto->types);
    }

}
