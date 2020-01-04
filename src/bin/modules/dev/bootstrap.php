<?php

use PhpLab\Sandbox\Dev\Commands\StressCommand;
use PhpLab\Sandbox\Dev\Domain\Services\StressService;
use Symfony\Component\Console\Application;

/**
 * @var Application $application
 */

// создаем и объявляем команды
$stressService = new StressService;
$command = new StressCommand(StressCommand::getDefaultName(), $stressService);
$application->add($command);
