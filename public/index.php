<?php

use Phalcon\Mvc\Application;

// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

include_once APP_PATH . '/config/services.php';
include_once APP_PATH . '/config/loader.php';
include_once APP_PATH . '/config/routes.php';
include_once APP_PATH . '/../vendor/autoload.php';

// Handling the application request
$application = new Application($di);
try {
    // Handle the request
    $response = $application->handle();

    $response->send();
} catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage();
}

