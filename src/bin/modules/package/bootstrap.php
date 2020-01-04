<?php

use PhpLab\Sandbox\Package\Commands\GitChangedCommand;
use PhpLab\Sandbox\Package\Commands\GitNeedReleaseCommand;
use PhpLab\Sandbox\Package\Commands\GitPullCommand;
use PhpLab\Sandbox\Package\Domain\Repositories\File\GitRepository;
use PhpLab\Sandbox\Package\Domain\Repositories\File\GroupRepository;
use PhpLab\Sandbox\Package\Domain\Repositories\File\PackageRepository;
use PhpLab\Sandbox\Package\Domain\Services\GitService;
use PhpLab\Sandbox\Package\Domain\Services\GroupService;
use PhpLab\Sandbox\Package\Domain\Services\PackageService;
use Symfony\Component\Console\Application;

/**
 * @var Application $application
 */

$fileName = __DIR__ . '/../../../../../../../vendor/php7lab/legacy/src/php7extension/core/package/domain/data/package_group.php';
$groupRepository = new GroupRepository($fileName);
$packageRepository = new PackageRepository($groupRepository);
$groupService = new GroupService($groupRepository, $packageRepository);

$packageService = new PackageService($packageRepository);

$gitRepository = new GitRepository($packageRepository);
$gitService = new GitService($gitRepository);
$command = new GitPullCommand(null, $packageService, $gitService);
$application->add($command);

$command = new GitChangedCommand(null, $gitService);
$application->add($command);

$command = new GitNeedReleaseCommand(null, $packageService, $gitService);
$application->add($command);
