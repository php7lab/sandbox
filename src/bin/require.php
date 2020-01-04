<?php

use Symfony\Component\Dotenv\Dotenv;

require __DIR__ . '/../../../../autoload.php';

if (!class_exists(Dotenv::class)) {
    throw new RuntimeException('Please run "composer require symfony/dotenv" to load the ".env" files configuring the application.');
} else {
    // load all the .env files
    (new Dotenv(false))->loadEnv(__DIR__ . '/../../../../../.env');
}
