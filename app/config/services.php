<?php

use Phalcon\Loader;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;


/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

///**
// * Database connection is created based in the parameters defined in the configuration file
// */
//$di->setShared('db', function () {
//    $config = $this->getConfig();
//
//    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
//    $params = [
//        'host'     => $config->database->host,
//        'username' => $config->database->username,
//        'password' => $config->database->password,
//        'dbname'   => $config->database->dbname,
//        'charset'  => $config->database->charset
//    ];
//
//    if ($config->database->adapter == 'Postgresql') {
//        unset($params['charset']);
//    }
//
//    $connection = new $class($params);
//
//    return $connection;
//});

// Simple database connection to localhost
//$di->set('mongo', function() {
//    $mongo = new Mongo();
//    return $mongo->selectDb("test");
//}, true);

//MongoDB Database
$di->set('MongoDB', function () use ($config) {
    if (!$config->database->mongo->username OR !$config->database->mongo->password) {
        $mongo = new MongoClient('mongodb://' . $config->database->mongo->host);
    } else {
        $mongo = new MongoClient("mongodb://" . $config->database->mongo->username . ":" . $config->database->mongo->password . "@" . $config->database->mongo->host, ["db" => $config->database->mongo->dbname]);
    }

    return $mongo->selectDb($config->database->mongo->dbname);
}, TRUE);

$di->set('collectionManager', function(){
    return new Phalcon\Mvc\Collection\Manager();
}, true);

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Configure the Volt service for rendering .volt templates
 */
$di->setShared('voltShared', function ($view) {
    $config = $this->getConfig();

    $volt = new VoltEngine($view, $this);
    $volt->setOptions([
        'compiledPath' => function($templatePath) use ($config) {
            $basePath = $config->application->appDir;
            if ($basePath && substr($basePath, 0, 2) == '..') {
                $basePath = dirname(__DIR__);
            }

            $basePath = realpath($basePath);
            $templatePath = trim(substr($templatePath, strlen($basePath)), '\\/');

            $filename = basename(str_replace(['\\', '/'], '_', $templatePath), '.volt') . '.php';

            $cacheDir = $config->application->cacheDir;
            if ($cacheDir && substr($cacheDir, 0, 2) == '..') {
                $cacheDir = __DIR__ . DIRECTORY_SEPARATOR . $cacheDir;
            }

            $cacheDir = realpath($cacheDir);

            if (!$cacheDir) {
                $cacheDir = sys_get_temp_dir();
            }

            if (!is_dir($cacheDir . DIRECTORY_SEPARATOR . 'volt' )) {
                @mkdir($cacheDir . DIRECTORY_SEPARATOR . 'volt' , 0755, true);
            }

            return $cacheDir . DIRECTORY_SEPARATOR . 'volt' . DIRECTORY_SEPARATOR . $filename;
        }
    ]);

    return $volt;
});
