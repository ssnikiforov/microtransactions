<?php

namespace Test;

use Domain\Deposit;
use MongoDB\BSON\ObjectId;
use MongoDB\Driver\Exception\RuntimeException;
use Phalcon\Db\Adapter\MongoDB\Database;
use Phalcon\Db\Adapter\MongoDB\InsertOneResult;

/**
 * Class UnitTest
 */
class DepositTest extends \UnitTestCase
{
    public function test_it_works()
    {
        /** @var Database $mongo */
        $mongo = $this->getDI()->get('mongo');
        $accounts = $mongo->selectCollection('accounts');
        $accounts->drop();
        /** @var InsertOneResult $result */
        $accounts->insert(['id' => 1, 'balance' => 100]);

        $command1 = new Deposit(1, 100);
        $command1->load();
        $command1->validate();
        $command1->doJob();
        $command1->save();

        $account = $accounts->findOne(['id' => 1]);
        $this->assertEquals(200, $account->balance);
    }

    public function test_concurrent()
    {
        /** @var Database $mongo */
        $mongo = $this->getDI()->get('mongo');
        $accounts = $mongo->selectCollection('accounts');
        $accounts->drop();
        /** @var InsertOneResult $result */
        $accounts->insert(['id' => 1, 'balance' => 1000]);

        $command1 = new Deposit(1, 100);
        $command2 = new Deposit(1, 50);
        $command1->load();
        $command2->load();
        $command2->validate();
        $command1->validate();
        $command1->doJob();
        $command2->doJob();
        $command1->save();
        $account = $accounts->findOne(['id' => 1]);
        $this->assertEquals(1100, $account->balance);

        $expect = 1150; // command2 success
        try {
            $command2->save();
        } catch (\Exception $e) {
            $expect = 1100; // command2 failed
        }

        $account = $accounts->findOne(['id' => 1]);
        $this->assertEquals($expect, $account->balance);
    }
}
