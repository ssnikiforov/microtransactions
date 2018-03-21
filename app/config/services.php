<?php

/******* DI *******/

// Create a DI
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Mvc\Url as UrlProvider;

$di = new FactoryDefault();

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
}
);

// Setup a base URI so that all generated URIs include the "tutorial" folder
$di->set('url', function () {
    $url = new UrlProvider();
    $url->setBaseUri('/');

    return $url;
}
);

return $di;
