<?php

use PhpLab\Sandbox\Generator\Commands\DomainCommand;
use PhpLab\Sandbox\Generator\Commands\ModuleCommand;
use PhpLab\Sandbox\Generator\Domain\Services\DomainService;
use PhpLab\Sandbox\Generator\Domain\Services\ModuleService;
use Symfony\Component\Console\Application;

/**
 * @var Application $application
 */

// создаем и объявляем команды
$domainService = new DomainService;
$moduleService = new ModuleService;

$command = new DomainCommand(null, $domainService);
$application->add($command);

$command = new ModuleCommand(null, $moduleService);
$application->add($command);
