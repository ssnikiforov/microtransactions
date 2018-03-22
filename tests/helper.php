<?php

use Phalcon\Di;
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Db\Adapter\MongoDB\Client;

ini_set("display_errors", 1);
error_reporting(E_ALL);

define("ROOT_PATH", __DIR__);
define("APP_PATH", ROOT_PATH . '/../app');

set_include_path(
    ROOT_PATH . PATH_SEPARATOR . get_include_path()
);
include __DIR__ . "/../vendor/autoload.php";

$loader = new Loader();
$loader->registerNamespaces([
    'Domain' => APP_PATH . '/domain/',
]);
$loader->registerDirs(
    [
        ROOT_PATH,
        APP_PATH . '/models/',
    ]
);
$loader->register();

