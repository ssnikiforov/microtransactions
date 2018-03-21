<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    'Microtransactions\Models' => APP_PATH . '/common/models/',
    'Microtransactions'        => APP_PATH . '/common/library/',
]);

$loader->registerDirs(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
    ]
);

$loader->register();
