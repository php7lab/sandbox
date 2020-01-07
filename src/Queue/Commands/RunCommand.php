<?php

namespace PhpLab\Sandbox\Queue\Commands;

use PhpLab\Sandbox\Queue\Domain\Interfaces\JobServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
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

    protected function configure()
    {
        $this->addArgument('channel', InputArgument::OPTIONAL);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<fg=white># Queue run</>');
        $output->writeln('');

        $channel = $input->getArgument('channel');
        if($channel) {
            $output->writeln("Channel: <fg=blue>{$channel}</>");
        } else {
            $output->writeln("Channel: <fg=blue>all</>");
        }

        $output->writeln('');

        $total = $this->jobService->runAll($channel);
        if ($total) {
            $output->writeln('<fg=green>Complete ' . $total . ' jobs!</>');
        } else {
            $output->writeln('<fg=magenta>Jobs empty!</>');
        }
        $output->writeln('');
    }

}
