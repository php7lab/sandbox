<?php

use Symfony\Component\Console\Application;

/**
 * @var Application $application
 */

// --- Bot ---

use PhpLab\Sandbox\Bot\Commands\BotCommand;

$command = new BotCommand;
$application->add($command);

// --- Stress ---

use PhpLab\Sandbox\Dev\Commands\StressCommand;
use PhpLab\Sandbox\Dev\Domain\Services\StressService;

// создаем и объявляем команды
$stressService = new StressService;
$command = new StressCommand(null, $stressService);
$application->add($command);

// --- Generator ---

use PhpLab\Sandbox\Generator\Commands\DomainCommand;
use PhpLab\Sandbox\Generator\Commands\ModuleCommand;
use PhpLab\Sandbox\Generator\Domain\Services\DomainService;
use PhpLab\Sandbox\Generator\Domain\Services\ModuleService;

// создаем и объявляем команды
$domainService = new DomainService;
$moduleService = new ModuleService;

$command = new DomainCommand(null, $domainService);
$application->add($command);

$command = new ModuleCommand(null, $moduleService);
$application->add($command);

// --- Package ---

use PhpLab\Sandbox\Package\Commands\GitChangedCommand;
use PhpLab\Sandbox\Package\Commands\GitNeedReleaseCommand;
use PhpLab\Sandbox\Package\Commands\GitPullCommand;
use PhpLab\Sandbox\Package\Commands\GitVersionCommand;
use PhpLab\Sandbox\Package\Domain\Repositories\File\GitRepository;
use PhpLab\Sandbox\Package\Domain\Repositories\File\GroupRepository;
use PhpLab\Sandbox\Package\Domain\Repositories\File\PackageRepository;
use PhpLab\Sandbox\Package\Domain\Services\GitService;
use PhpLab\Sandbox\Package\Domain\Services\PackageService;

$fileName = __DIR__ . '/../src/Package/Domain/Data/package_group.php';
$groupRepository = new GroupRepository($fileName);
$packageRepository = new PackageRepository($groupRepository);
$gitRepository = new GitRepository($packageRepository);

$packageService = new PackageService($packageRepository);
$gitService = new GitService($gitRepository);

$command = new GitPullCommand(null, $packageService, $gitService);
$application->add($command);

$command = new GitChangedCommand(null, $packageService, $gitService);
$application->add($command);

$command = new GitNeedReleaseCommand(null, $packageService, $gitService);
$application->add($command);

$command = new GitVersionCommand(null, $packageService, $gitService);
$application->add($command);
