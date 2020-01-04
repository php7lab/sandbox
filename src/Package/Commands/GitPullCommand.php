<?php

namespace PhpLab\Sandbox\Package\Commands;

use Illuminate\Support\Collection;
use PhpLab\Sandbox\Package\Domain\Entities\PackageEntity;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GitPullCommand extends BaseCommand
{

    protected static $defaultName = 'package:git:pull';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<fg=white># Packages git pull</>');
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
                $result = $this->gitService->pullPackage($packageEntity);
                if ($result == 'Already up to date.') {
                    $result = "<fg=green>{$result}</>";
                } else {
                    $totalCollection->add($packageEntity);
                }
                $output->writeln($result);
            }
        } else {
            $output->writeln('<fg=magenta>Not found packages!</>');
        }
        return $totalCollection;
    }

    private function displayTotal(Collection $totalCollection, InputInterface $input, OutputInterface $output)
    {
        /** @var PackageEntity[] | Collection $totalCollection */
        if ($totalCollection->count()) {
            $output->writeln('<fg=yellow>Updated packages!</>');
            $output->writeln('');
            foreach ($totalCollection as $packageEntity) {
                $packageId = $packageEntity->getId();
                $output->writeln("<fg=yellow> {$packageId}</>");
            }
        } else {
            $output->writeln('<fg=green>All packages already up-to-date!</>');
        }
    }
}
