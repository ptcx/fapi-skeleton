<?php

namespace App\Http\Service;

class ResqueService
{
    private $needAuth;

    private $server;
    private $passwd;
    private $database;

    public function __construct($server, $passwd='', $database=0)
    {
        $this->server = $server;
        $this->passwd = $passwd;
        $this->database = $database;

        $this->needAuth = empty($this->passwd) ? false : true;

        \Resque::setBackend($server, $database);
    }

    public function push($queue, $className, $args, $trackStatus = false)
    {
        if ($this->needAuth && !empty($this->passwd)) {
            \Resque::redis()->auth($this->passwd);
            $this->needAuth = false;
        }
        return \Resque::enqueue($queue, $className, $args, $trackStatus);
    }
}