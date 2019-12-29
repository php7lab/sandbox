<?php

namespace PhpLab\Sandbox\Queue\Domain\Interfaces;

use Symfony\Component\DependencyInjection\ContainerInterface;

interface JobInterface
{

    public function run();
    public function setContainer(ContainerInterface $container = null);

}