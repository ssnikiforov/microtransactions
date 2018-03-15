<?php

defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

return new \Phalcon\Config([
//        'database' => [
//            'adapter' => 'Postgresql',
//            'host' => 'localhost',
//            'username' => 'postgres',
//            'password' => '',
//            'dbname' => 'microtransactions_system',
//            'charset' => 'utf8',
//        ],
'database' => [
    'mongo' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'dbname' => 'microtransactions_system',
    ]
],
'application' => [
    'appDir' => APP_PATH . '/',
    'controllersDir' => __DIR__ . '/../../app/controllers/',
    'modelsDir' => __DIR__ . '/../../app/models/',
    'viewsDir' => __DIR__ . '/../../app/views/',
    'pluginsDir' => __DIR__ . '/../../app/plugins/',
    'libraryDir' => __DIR__ . '/../../app/library/',
    'cacheDir' => __DIR__ . '/../../app/cache/',
    'baseUri' => preg_replace('/public([\/\\\\])index.php$/', '', $_SERVER["PHP_SELF"]),
],
'printNewLine' => true
    ]
);
