<?php

use PhpLab\Sandbox\Generator\Commands\DomainCommand;
use PhpLab\Sandbox\Generator\Domain\Services\DomainService;
use Symfony\Component\Console\Application;

/**
 * @var Application $application
 */

// создаем и объявляем команды
$domainService = new DomainService;
$command = new DomainCommand(null, $domainService);
$application->add($command);
