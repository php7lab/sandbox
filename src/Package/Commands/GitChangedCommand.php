<?php

namespace PhpLab\Sandbox\Package\Commands;

use Illuminate\Support\Collection;
use PhpLab\Sandbox\Package\Domain\Entities\PackageEntity;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GitChangedCommand extends BaseCommand
{

    protected static $defaultName = 'package:git:changed';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<fg=white># Packages with changes</>');
        $collection = $this->packageService->all();
        $output->writeln('');
        $totalCollection = $this->displayProgress($collection, $input, $output);
        $output->writeln('');
        $this->displayTotal($totalCollection, $input, $output);
        $output->writeln('');
    }

    private function displayProgress(Collection $collection, InputInterface $input, OutputInterface $output): Collection
    {
        /** @var PackageEntity[] | Collection $collection */
        /** @var PackageEntity[] | Collection $totalCollection */
        $totalCollection = new Collection;
        if ($collection->count()) {
            foreach ($collection as $packageEntity) {
                $packageId = $packageEntity->getId();
                $output->write(" $packageId ... ");
                $isHasChanges = $this->gitService->isHasChanges($packageEntity);
                if ($isHasChanges) {
                    $output->writeln("<fg=yellow>Has changes</>");
                    $totalCollection->add($packageEntity);
                } else {
                    $output->writeln("<fg=green>OK</>");
                }
            }
        } else {
            $output->writeln('<fg=magenta>No changes!</>');
        }
        return $totalCollection;
    }

    private function displayTotal(Collection $totalCollection, InputInterface $input, OutputInterface $output)
    {
        /** @var PackageEntity[] | Collection $totalCollection */
        if ($totalCollection->count()) {
            $output->writeln('<fg=yellow>Has changes:</>');
            $output->writeln('');
            foreach ($totalCollection as $packageEntity) {
                $packageId = $packageEntity->getId();
                $output->writeln("<fg=yellow> {$packageId}</>");
            }
        } else {
            $output->writeln('<fg=magenta>No changes!</>');
        }
    }
}
