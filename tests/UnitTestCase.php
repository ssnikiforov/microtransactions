<?php

use Phalcon\Db\Adapter\MongoDB\Client;
use Phalcon\Test\UnitTestCase as PhalconTestCase;
use Phalcon\Mvc\Collection\Manager as CollectionManager;

abstract class UnitTestCase extends PhalconTestCase
{
    /**
     * @var bool
     */
    private $_loaded = false;

    public function setUp()
    {
        parent::setUp();

        $di = $this->getDI();

        $di->set('mongo', function () {
            $mongo = new Client('mongodb://mongo:27017');

            return $mongo->selectDatabase('test');
        });

        $di->set('collectionManager', function () {
            return new CollectionManager();
        });

        $this->_loaded = true;
    }
}
