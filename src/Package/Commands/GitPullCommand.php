<?php

namespace PhpLab\Sandbox\Package\Commands;

use PhpLab\Sandbox\Package\Domain\Entities\PackageEntity;
use PhpLab\Sandbox\Package\Domain\Interfaces\Services\GitServiceInterface;
use PhpLab\Sandbox\Package\Domain\Interfaces\Services\PackageServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GitPullCommand extends Command
{

    protected static $defaultName = 'package:git:pull';
    private $packageService;
    private $gitService;

    public function __construct(?string $name = null, PackageServiceInterface $packageService, GitServiceInterface $gitService)
    {
        parent::__construct($name);
        $this->packageService = $packageService;
        $this->gitService = $gitService;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<fg=white># Packages git pull</>');
        /** @var PackageEntity[] | \Illuminate\Support\Collection $collection */
        $collection = $this->packageService->all();
        $output->writeln('');
        if ($collection->count()) {
            foreach ($collection as $packageEntity) {
                $title = $packageEntity->getId() . ' ... ';
                $output->write($title);
                $result = $this->gitService->pullPackage($packageEntity);
                if ($result == 'Already up to date.') {
                    $result = "<fg=green>{$result}</>";
                }
                $output->writeln($result);
            }
        } else {
            $output->writeln('<fg=red>No packages!</>');
        }
        $output->writeln('');
    }

}
