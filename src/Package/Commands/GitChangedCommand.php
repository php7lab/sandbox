<?php

namespace PhpLab\Sandbox\Package\Commands;

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

        /** @var PackageEntity[] | \Illuminate\Support\Collection $collection */
        $collection = $this->packageService->all();
        //$collection = $this->gitService->allChanged();
        $output->writeln('');
        if ($collection->count()) {
            foreach ($collection as $packageEntity) {
                $output->write($packageEntity->getId() . ' ... ');
                $isHasChanges = $this->gitService->isHasChanges($packageEntity);
                if ($isHasChanges) {
                    $output->writeln("<fg=yellow>Has changes</>");
                } else {
                    $output->writeln("<fg=green>OK</>");
                }
            }
        } else {
            $output->writeln('<fg=green>No changes!</>');
        }
        $output->writeln('');
    }

}
