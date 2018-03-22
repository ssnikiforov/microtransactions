<?php

namespace Domain;

abstract class Command
{
    public function execute()
    {
        $this->load();
        $this->validate();
        $this->doJob();
        $this->save();
    }

    abstract public function load();

    abstract public function validate();

    abstract public function doJob();

    abstract public function save();
}
