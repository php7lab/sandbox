<?php

namespace PhpLab\Sandbox\Proto\Interfaces;

interface TransportInterface
{

    public function sendRequest($encodedRequest);

}