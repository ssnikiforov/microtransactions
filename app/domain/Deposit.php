<?php

namespace Domain;

use Accounts;
use RuntimeException;

class Deposit extends Command
{
    private $id;
    private $amount;
    /** @var Accounts $account */
    private $account;

    /**
     * Deposit constructor.
     *
     * @param $id
     * @param $amount
     *
     * @throws RuntimeException
     */
    public function __construct($id, $amount)
    {
        if ($id <= 0) {
            throw new RuntimeException('Account number should be non negative');
        }
        if ($amount <= 0) {
            throw new RuntimeException('Amount should be non negative');
        }

        $this->id = (int)$id;
        $this->amount = (int)$amount;
    }

    public function load()
    {
        $account = Accounts::findFirst([
            ['id' => $this->id]
        ]);
        if (!$account) {
            throw new RuntimeException('Account not found');
        }
        $this->account = $account;
    }

    /**
     *
     * @throws RuntimeException
     */
    public function validate()
    {
        if ($this->account->balance < 0) {
            throw new RuntimeException('Account is strange (negative balance)');
        }
    }

    public function doJob()
    {
        $this->account->balance += $this->amount;
    }

    /**
     * @throws \Phalcon\Mvc\Collection\Exception
     */
    public function save()
    {
        $this->account->save();
    }
}
