<?php

namespace PhpLab\Sandbox\Package\Commands;

use PhpLab\Domain\Data\Collection;
use PhpLab\Sandbox\Package\Domain\Entities\TestEntity;
use PhpLab\Sandbox\Package\Domain\Repositories\File\GroupRepository;
use PhpLab\Sandbox\Package\Domain\Services\GroupService;
use PhpLab\Sandbox\Package\Domain\Services\InfoService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InfoChangedCommand extends Command
{

    protected static $defaultName = 'package:info:changed';
    private $infoService;

    public function __construct(?string $name = null, InfoService $infoService)
    {
        parent::__construct($name);
        $this->infoService = $infoService;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(['<fg=white># Stress test</>']);

        /*$fileName = __DIR__ . '/../../../../../../vendor/php7extension/core/src/package/domain/data/package_group.php';
        $groupRepository = new GroupRepository($fileName);
        $groupService = new GroupService($groupRepository);
        dd($groupService->all());*/

        $collection = $this->infoService->allChanged();
        dd($collection);
    }

}
