#!/usr/bin/env php
<?php

use Zend\Console\Console;
use Zend\ServiceManager\ServiceManager;
use ZF\Console\Application;
use ZF\Console\Dispatcher;

if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    throw new Exception(
        'Composer autoload script not found. Run \'composer install\''
    );
}

require_once __DIR__ . '/../vendor/autoload.php';

$appConfig = include __DIR__ . '/../config/application.php';
$serviceManagerConfig = include __DIR__ . '/../config/services.php';

$serviceManager = new ServiceManager($serviceManagerConfig);
$dispatcher = new Dispatcher($serviceManager);

$application = new Application(
    $appConfig['name'],
    $appConfig['version'],
    include __DIR__ . '/../config/routes.php',
    Console::getInstance(),
    $dispatcher
);

$exit = $application->run();
exit($exit);
