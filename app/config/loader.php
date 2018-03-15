<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    'Microtransactions\Models' => APP_PATH . '/common/models/',
    'Microtransactions' => APP_PATH . '/common/library/',
]);

/**
 * Register module classes
 */
$loader->registerClasses([
    'Microtransactions\Modules\Frontend\Module' => APP_PATH . '/modules/frontend/Module.php',
    'Microtransactions\Modules\Cli\Module' => APP_PATH . '/modules/cli/Module.php'
]);

$loader->register();
