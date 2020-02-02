<?php

use Symfony\Component\Console\Application;

/**
 * @var Application $application
 */

// --- Bot ---

use PhpLab\Sandbox\Bot\Commands\BotCommand;

$command = new BotCommand;
$application->add($command);
