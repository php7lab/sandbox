<?php

namespace PhpLab\Sandbox\Common\Libs\Store\Drivers;

interface DriverInterface
{

    public function decode($content);

    public function encode($data);

}