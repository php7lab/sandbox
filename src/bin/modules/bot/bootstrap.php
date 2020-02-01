<?php

use PhpLab\Sandbox\Bot\Commands\BotCommand;
/**
 * @var Application $application
 */

$command = new BotCommand(null, $domainService);
$application->add($command);
