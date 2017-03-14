<?php

namespace App\Script\Normal;

use App\Script\ScriptBase;

class Test extends ScriptBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run($param)
    {
        var_dump($param); echo "\n";
    }
}