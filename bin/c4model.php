#!/usr/bin/env php
<?php

use App\Docs\C4Model\C4Model\Application\GeneratorService;
use Symfony\Component\Dotenv\Dotenv;

ini_set('memory_limit', '-1');
if (false === in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true)) {
    echo 'Warning: The console should be invoked via the CLI version of PHP, not the ' . \PHP_SAPI . ' SAPI' . \PHP_EOL;
}

set_time_limit(0);

require dirname(__DIR__) . '/vendor/autoload.php';

// Load cached env vars if the .env.local.php file exists
// Run "composer dump-env prod" to create it (requires symfony/flex >=1.2)
if (is_array($env = @include dirname(__DIR__) . '/.env.local.php')) {
    $_ENV += $env;
} elseif (!class_exists(Dotenv::class)) {
    throw new RuntimeException('Please run "composer require symfony/dotenv" to load the ".env" files configuring the application.');
} else {
    // load all the .env files
    (new Dotenv(true))->loadEnv(dirname(__DIR__) . '/.env');
}

$generator = new GeneratorService();
$generator->run();
