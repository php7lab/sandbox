<?php

namespace PhpLab\Sandbox\Package\Commands;

use Illuminate\Support\Collection;
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

        /** @var PackageEntity[] | Collection $collection */
        $collection = $this->packageService->all();

        /** @var PackageEntity[] | Collection $releaseCollection */
        $releaseCollection = new Collection;

        $output->writeln('');
        if ($collection->count()) {
            foreach ($collection as $packageEntity) {
                $packageId = $packageEntity->getId();
                $output->write(" $packageId ... ");
                $isNeedRelease = $this->gitService->isNeedRelease($packageEntity);
                if ($isNeedRelease) {
                    $output->writeln("<fg=yellow>Need release</>");
                    $releaseCollection->add($packageEntity);
                } else {
                    $output->writeln("<fg=green>OK</>");
                }
            }
        }

        $output->writeln('');
        if($releaseCollection->count()) {
            $output->writeln('<fg=yellow>Need release!</>');
            $output->writeln('');
            foreach ($releaseCollection as $packageEntity) {
                $packageId = $packageEntity->getId();
                $output->writeln("<fg=yellow> {$packageId}</>");
            }
        } else {
            $output->writeln('<fg=magenta>Not found packages!</>');
        }
        $output->writeln('');
    }

}
