<?php

/**
 * User: Stepan S. Nikiforov (s.nikiforov@innosoft.ru)
 * Date: 22/12/2017
 * Time: 21:24
 */

use Phalcon\Mvc\MongoCollection;

class Accounts extends MongoCollection
{
    public $id;
    public $balance;
}
