<?php
/**
 * User: Stepan S. Nikiforov (s.nikiforov@innosoft.ru)
 * Date: 22/12/2017
 * Time: 21:32
 */

return new \Phalcon\Config(
    [
        'database' => [
            'adapter' => 'Postgresql',
            'host' => 'localhost',
            'username' => 'postgres',
            'password' => '',
            'dbname' => 'microtransactions_system',
            'charset' => 'utf8',
        ],
    ],
    [
        'application' => [
            'controllersDir' => __DIR__ . '/../../app/controllers/',
            'modelsDir' => __DIR__ . '/../../app/models/',
            'viewsDir' => __DIR__ . '/../../app/views/',
            'pluginsDir' => __DIR__ . '/../../app/plugins/',
            'libraryDir' => __DIR__ . '/../../app/library/',
            'cacheDir' => __DIR__ . '/../../app/cache/',
            'baseUri' => '/test/',
        ],
    ]
);
