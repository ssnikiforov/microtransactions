<?php

/******* DI *******/

// Create a DI
use Phalcon\Db\Adapter\MongoDB\Client;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\Collection\Manager as CollectionManager;

$di = new FactoryDefault();
$config = include APP_PATH . '/config/config.php';

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . '/config/config.php';
});

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
});

// Setup a base URI so that all generated URIs include the "tutorial" folder
$di->set('url', function () {
    $url = new UrlProvider();
    $url->setBaseUri('/');

    return $url;
});

$di->setShared('mongo', function () use ($config) {
    $mongo = new Client('mongodb://mongo:27017');

    return $mongo->selectDatabase($config->database->mongo->dbname);
});

$di->setShared('eventsManager', function () {
    return new EventsManager();
});

// Registering the collectionManager service
$di->setShared('collectionManager', function () use ($di) {
    $modelsManager = new CollectionManager();
    $modelsManager->setEventsManager($di->getShared('eventsManager'));

    return $modelsManager;
});
