<?php

use PhpLab\Sandbox\Package\Commands\GitChangedCommand;
use PhpLab\Sandbox\Package\Commands\GitNeedReleaseCommand;
use PhpLab\Sandbox\Package\Commands\GitPullCommand;
use PhpLab\Sandbox\Package\Commands\GitVersionCommand;
use PhpLab\Sandbox\Package\Domain\Repositories\File\GitRepository;
use PhpLab\Sandbox\Package\Domain\Repositories\File\GroupRepository;
use PhpLab\Sandbox\Package\Domain\Repositories\File\PackageRepository;
use PhpLab\Sandbox\Package\Domain\Services\GitService;
use PhpLab\Sandbox\Package\Domain\Services\PackageService;
use Symfony\Component\Console\Application;

/**
 * @var Application $application
 */

$fileName = __DIR__ . '/../../../Package/Domain/Data/package_group.php';
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
