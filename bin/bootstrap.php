<?php

use Symfony\Component\Console\Application;
use PhpLab\Eloquent\Db\Helpers\Manager;

/**
 * @var Application $application
 */

$eloquentConfigFile = $_ENV['ELOQUENT_CONFIG_FILE'];
$capsule = new Manager(null, $eloquentConfigFile);

// --- Bot ---

use PhpLab\Sandbox\Bot\Symfony\Commands\BotCommand;

$command = new BotCommand;
$application->add($command);

// --- Queue ---

use PhpLab\Sandbox\Queue\Symfony\Commands\RunCommand;
use Symfony\Component\DependencyInjection\Container;
use PhpLab\Sandbox\Queue\Domain\Services\JobService;
use PhpLab\Sandbox\Queue\Domain\Repositories\Eloquent\JobRepository;

$container = new Container;
$jobRepository = new JobRepository($capsule);
$jobService = new JobService($jobRepository, $container);

$command = new RunCommand;
$application->add($command);
