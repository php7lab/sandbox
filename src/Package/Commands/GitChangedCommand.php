<?php

namespace PhpLab\Sandbox\Package\Commands;

use Illuminate\Support\Collection;
use PhpLab\Sandbox\Package\Domain\Entities\PackageEntity;
use PhpLab\Sandbox\Package\Domain\Interfaces\Services\GitServiceInterface;
use PhpLab\Sandbox\Package\Domain\Interfaces\Services\PackageServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GitChangedCommand extends Command
{

    protected static $defaultName = 'package:git:changed';
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
        $output->writeln('<fg=white># Packages with changes</>');

        /** @var PackageEntity[] | Collection $collection */
        $collection = $this->packageService->all();
        //$collection = $this->gitService->allChanged();
        $output->writeln('');

        /** @var PackageEntity[] | Collection $changedCollection */
        $changedCollection = new Collection;

        if ($collection->count()) {
            foreach ($collection as $packageEntity) {
                $packageId = $packageEntity->getId();
                $output->write(" $packageId ... ");
                $isHasChanges = $this->gitService->isHasChanges($packageEntity);
                if ($isHasChanges) {
                    $output->writeln("<fg=yellow>Has changes</>");
                    $changedCollection->add($packageEntity);
                } else {
                    $output->writeln("<fg=green>OK</>");
                }
            }
        } else {
            $output->writeln('<fg=magenta>No changes!</>');
        }
        $output->writeln('');
        if($changedCollection->count()) {
            $output->writeln('<fg=yellow>Has changes:</>');
            $output->writeln('');
            foreach ($changedCollection as $packageEntity) {
                $packageId = $packageEntity->getId();
                $output->writeln("<fg=yellow> {$packageId}</>");
            }
        } else {
            $output->writeln('<fg=magenta>No changes!</>');
        }
        $output->writeln('');
    }

}
