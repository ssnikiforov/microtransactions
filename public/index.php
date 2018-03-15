<?php

use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Db\Adapter\Pdo\Postgresql as DbAdapter;
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlProvider;

/******* LOADER *******/

// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

$loader = new Loader();

$config = include APP_PATH . 'config/config.php';

$loader->registerDirs(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
    ]
);

$loader->register();

/******* DI *******/
// Create a DI
$di = new FactoryDefault();

/**
 * Read composer auto-loader
 */
include_once __DIR__ . '/../../vendor/autoload.php';

$di->setShared('sys', function () use ($config) {
    return $config;
});

// Setup the view component
$di->set('view', function () {
    $view = new View();
    $view->setViewsDir(APP_PATH . '/views/');

    $view->registerEngines([
        '.volt' => Volt::class
    ]);

    return $view;
}
);

// Setup a base URI so that all generated URIs include the "tutorial" folder
$di->set('url', function () {
    $url = new UrlProvider();
    $url->setBaseUri('/');

    return $url;
}
);

// Handling the application request
$application = new Application($di);
try {
    // Handle the request
    $response = $application->handle();

    $response->send();
} catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage();
}

// Setup the database service
$di->set('db', function () use ($config) {
    return new DbAdapter(
        [
            'host' => $config->database->host,
            'username' => $config->database->username,
            'password' => $config->database->password,
            'dbname' => $config->database->dbname,
            "charset" => $config->database->charset
        ]
    );
}
);

//$connection = new Postgresql($dbConfig);
//print_r($connection);

//$di->set('db', function () use ($config) {
//    return new DbAdapter(array(
//        'host' => $config->database->host,
//        'username' => $config->database->username,
//        'password' => $config->database->password,
//        'dbname' => $config->database->dbname,
//        "charset" => $config->database->charset
//    ));
//});
