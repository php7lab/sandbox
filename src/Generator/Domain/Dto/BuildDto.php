<?php

namespace PhpLab\Sandbox\Generator\Domain\Dto;

class BuildDto
{

    public $domainName = '';
    public $domainNamespace;
    public $typeModule;
    public $moduleNamespace;
    public $types;
    public $name;
    public $attributes = [];
    public $driver;
    public $typeArray;
    public $isCrudService;
    public $isCrudRepository;
    public $isCrudController;
}
