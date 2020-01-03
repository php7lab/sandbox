<?php

namespace PhpLab\Sandbox\Package\Commands;

use PhpLab\Sandbox\Package\Domain\Entities\PackageEntity;
use PhpLab\Sandbox\Package\Domain\Interfaces\Services\PackageServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GitPullCommand extends Command
{

    protected static $defaultName = 'package:git:pull';
    private $packageService;

    public function __construct(?string $name = null, PackageServiceInterface $packageService)
    {
        parent::__construct($name);
        $this->packageService = $packageService;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(['<fg=white># Packages git pull</>']);
        /** @var PackageEntity[] | \Illuminate\Support\Collection $collection */
        $collection = $this->packageService->all();
        $output->writeln(['']);
        if ($collection->count()) {
            foreach ($collection as $packageEntity) {
                $output->writeln([$packageEntity->getId()]);
                $this->packageService->pullPackage($packageEntity);
            }
        } else {
            $output->writeln(['<fg=red>No packages!</>']);
        }
        $output->writeln(['']);
    }

}
