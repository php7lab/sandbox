<?php

namespace PhpLab\Sandbox\Package\Commands;

use Illuminate\Support\Collection;
use PhpLab\Sandbox\Package\Domain\Entities\PackageEntity;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GitVersionCommand extends BaseCommand
{

    protected static $defaultName = 'package:git:version';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<fg=white># Packages version</>');
        $collection = $this->packageService->all();
        $output->writeln('');
        $totalCollection = $this->displayProgress($collection, $input, $output);
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
                $lastVersion = $this->gitService->lastVersion($packageEntity);
                if ($lastVersion) {
                    $output->writeln("<fg=green>{$lastVersion}</>");
                } else {
                    $output->writeln("<fg=yellow>dev-master</>");
                }
            }
        } else {
            $output->writeln('<fg=green>No changes!</>');
        }
        return $totalCollection;
    }
}
