<?php

use PhpLab\Sandbox\Messenger\Commands\BotCommand;
/**
 * @var Application $application
 */

$command = new BotCommand(null, $domainService);
$application->add($command);
