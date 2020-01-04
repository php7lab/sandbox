<?php

namespace PhpLab\Sandbox\Package\Commands;

use PhpLab\Sandbox\Package\Domain\Entities\PackageEntity;
use PhpLab\Sandbox\Package\Domain\Interfaces\Services\GitServiceInterface;
use PhpLab\Sandbox\Package\Domain\Interfaces\Services\PackageServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GitNeedReleaseCommand extends Command
{

    protected static $defaultName = 'package:git:need-release';
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

        $output->writeln('<fg=white># Packages need release</>');
        //return;

        /** @var PackageEntity[] | \Illuminate\Support\Collection $collection */
        $collection = $this->packageService->all();
        //dd($collection);

        $output->writeln('');
        if ($collection->count()) {
            foreach ($collection as $packageEntity) {

                $isNeedRelease = $this->gitService->isNeedRelease($packageEntity);

                if($isNeedRelease) {
                    $title = $packageEntity->getId();
                    $output->writeln($title);
                }

                /*if ($result == 'Already up to date.') {
                    $result = "<fg=green>{$result}</>";
                }
                $output->writeln($result);*/
            }
        } else {
            $output->writeln('<fg=red>No packages!</>');
        }
        $output->writeln('');
    }

}
