<?php

namespace PhpLab\Sandbox\Package\Commands;

use PhpLab\Sandbox\Package\Domain\Entities\PackageEntity;
use PhpLab\Sandbox\Package\Domain\Interfaces\Services\GitServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GitChangedCommand extends Command
{

    protected static $defaultName = 'package:git:changed';
    private $gitService;

    public function __construct(?string $name = null, GitServiceInterface $gitService)
    {
        parent::__construct($name);
        $this->gitService = $gitService;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<fg=white># Packages with changes</>');
        /** @var PackageEntity[] | \Illuminate\Support\Collection $collection */
        $collection = $this->gitService->allChanged();
        $output->writeln('');
        if ($collection->count()) {
            foreach ($collection as $packageEntity) {
                $output->writeln([$packageEntity->getId()]);
            }
        } else {
            $output->writeln('<fg=green>No changes!</>');
        }
        $output->writeln('');
    }

}
