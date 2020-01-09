<?php

namespace PhpLab\Sandbox\Generator\Commands;

use PhpLab\Sandbox\Generator\Domain\Dto\BuildDto;
use PhpLab\Sandbox\Generator\Domain\Interfaces\Services\ModuleServiceInterface;
use PhpLab\Sandbox\Generator\Domain\Scenarios\Input\BaseInputScenario;
use PhpLab\Sandbox\Generator\Domain\Scenarios\Input\ModuleNamespaceInputScenario;
use PhpLab\Sandbox\Generator\Domain\Scenarios\Input\NameInputScenario;
use PhpLab\Sandbox\Generator\Domain\Scenarios\Input\TypeModuleInputScenario;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ModuleCommand extends Command
{

    protected static $defaultName = 'generator:module';
    private $moduleService;

    public function __construct(?string $name = null, ModuleServiceInterface $moduleService)
    {
        parent::__construct($name);
        $this->moduleService = $moduleService;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<fg=white># Module generator</>');
        $buildDto = new BuildDto;
        $this->input($input, $output, $buildDto);
        $this->moduleService->generate($buildDto);
    }

    private function input(InputInterface $input, OutputInterface $output, BuildDto $buildDto)
    {
        $buildDto->moduleNamespace = 'App\\Api';
        $buildDto->typeModule = 'api';
        /*$buildDto->moduleNamespace = 'App\\Web';
        $buildDto->typeModule = 'web';*/

        $buildDto->moduleName = 'app';
        $buildDto->name = 'qwerty';
        $buildDto->endpoint = 'qwerty';

        return;

        $this->runInputScenario(NameInputScenario::class, $input, $output, $buildDto);
        $this->runInputScenario(ModuleNamespaceInputScenario::class, $input, $output, $buildDto);
        $this->runInputScenario(TypeModuleInputScenario::class, $input, $output, $buildDto);
    }

    private function runInputScenario(string $className, InputInterface $input, OutputInterface $output, BuildDto $buildDto)
    {
        $output->writeln('');
        /** @var BaseInputScenario $inputScenario */
        $inputScenario = new $className;
        $inputScenario->helper = $this->getHelper('question');
        $inputScenario->input = $input;
        $inputScenario->output = $output;
        $inputScenario->buildDto = $buildDto;
        return $inputScenario->run();
    }

}
