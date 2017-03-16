<?php
/**
 * 所有Job均需继承此基类
 */

namespace App\Job;

abstract class Job
{
    protected $server;
    protected $redisQueue;

    public function initResque($server,  $passwd='', $database=0)
    {
        \Resque::setBackend($server, $database);
        if (!empty($passwd)) {
            \Resque::redis()->auth($passwd);
        }
        return $this;
    }

    public function onQueue($queue)
    {
        $this->redisQueue = $queue;
        return $this;
    }

    public function push($args, $trackStatus = false)
    {
        return \Resque::enqueue($this->redisQueue, static::class, $args, $trackStatus);
    }

    abstract public function perform();
}