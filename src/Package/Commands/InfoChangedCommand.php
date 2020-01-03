<?php

namespace PhpLab\Sandbox\Package\Commands;

use PhpLab\Domain\Data\Collection;
use PhpLab\Sandbox\Package\Domain\Entities\PackageEntity;
use PhpLab\Sandbox\Package\Domain\Entities\TestEntity;
use PhpLab\Sandbox\Package\Domain\Interfaces\Services\PackageServiceInterface;
use PhpLab\Sandbox\Package\Domain\Repositories\File\GroupRepository;
use PhpLab\Sandbox\Package\Domain\Services\GroupService;
use PhpLab\Sandbox\Package\Domain\Services\InfoService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InfoChangedCommand extends Command
{

    protected static $defaultName = 'package:info:changed';
    private $packageService;

    public function __construct(?string $name = null, PackageServiceInterface $packageService)
    {
        parent::__construct($name);
        $this->packageService = $packageService;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(['<fg=white># Package changed</>']);

        /** @var PackageEntity[] | \Illuminate\Support\Collection $collection */
        $collection = $this->packageService->allChanged();
        $output->writeln(['']);
        if($collection->count()) {
            foreach ($collection as $packageEntity) {
                $output->writeln([$packageEntity->getId()]);
            }
        } else {
            $output->writeln(['<fg=green>No changes!</>']);
        }
        $output->writeln(['']);
    }

}
