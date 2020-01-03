<?php

namespace PhpLab\Sandbox\Generator\Commands;

use PhpLab\Sandbox\Generator\Domain\Dto\BuildDto;
use PhpLab\Sandbox\Generator\Domain\Interfaces\DomainServiceInterface;
use PhpLab\Sandbox\Generator\Domain\Scenarios\Input\BaseInputScenario;
use PhpLab\Sandbox\Generator\Domain\Scenarios\Input\DomainNamespaceInputScenario;
use PhpLab\Sandbox\Generator\Domain\Scenarios\Input\DriverInputScenario;
use PhpLab\Sandbox\Generator\Domain\Scenarios\Input\EntityAttributesInputScenario;
use PhpLab\Sandbox\Generator\Domain\Scenarios\Input\IsCrudRepositoryInputScenario;
use PhpLab\Sandbox\Generator\Domain\Scenarios\Input\IsCrudServiceInputScenario;
use PhpLab\Sandbox\Generator\Domain\Scenarios\Input\NameInputScenario;
use PhpLab\Sandbox\Generator\Domain\Scenarios\Input\TypeInputScenario;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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

        //dd($buildDto);

        $this->domainService->generate($buildDto);
    }

    private function input(InputInterface $input, OutputInterface $output, BuildDto $buildDto)
    {
        $this->runInputScenario(DomainNamespaceInputScenario::class, $input, $output, $buildDto);
        $this->runInputScenario(TypeInputScenario::class, $input, $output, $buildDto);
        $this->runInputScenario(NameInputScenario::class, $input, $output, $buildDto);

        $typesFlip = array_flip($buildDto->typeArray);

        if (in_array($typesFlip['entity'], $buildDto->types)) {
            $this->runInputScenario(EntityAttributesInputScenario::class, $input, $output, $buildDto);
        }

        if (in_array($typesFlip['service'], $buildDto->types)) {
            $this->runInputScenario(IsCrudServiceInputScenario::class, $input, $output, $buildDto);
        }

        if (in_array($typesFlip['repository'], $buildDto->types)) {
            $this->runInputScenario(DriverInputScenario::class, $input, $output, $buildDto);
            $this->runInputScenario(IsCrudRepositoryInputScenario::class, $input, $output, $buildDto);
        }
    }

    private function runInputScenario(string $className, InputInterface $input, OutputInterface $output, BuildDto $buildDto)
    {
        /** @var BaseInputScenario $inputScenario */
        $inputScenario = new $className;
        $inputScenario->helper = $this->getHelper('question');
        $inputScenario->input = $input;
        $inputScenario->output = $output;
        $inputScenario->buildDto = $buildDto;
        return $inputScenario->run();
    }

}
