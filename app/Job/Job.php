<?php
/**
 * 所有Job均需继承此基类
 */

namespace App\Job;

abstract class Job
{
    public function setUp() {}

    public function tearDown() {}

    abstract public function perform();
}