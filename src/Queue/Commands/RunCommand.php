<?php

namespace PhpLab\Sandbox\Queue\Commands;

use PhpLab\Sandbox\Queue\Domain\Interfaces\JobServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends Command
{

    protected static $defaultName = 'queue:run';
    private $jobService;

    public function __construct(?string $name = null, JobServiceInterface $jobService)
    {
        parent::__construct($name);
        $this->jobService = $jobService;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(['<fg=white># Queue run</>']);
        $output->writeln(['']);
        $total = $this->jobService->runAll();
        if ($total) {
            $output->writeln(['<fg=green>Complete ' . $total . ' jobs!</>']);
        } else {
            $output->writeln(['<fg=green>Jobs empty!</>']);
        }
        $output->writeln(['']);
    }

}
