<?php

namespace App\Job;

class TestJob extends Job
{
    public function setUp()
    {}

    public function perform()
    {
        var_dump($this->args);
    }

    public function tearDown()
    {}
}