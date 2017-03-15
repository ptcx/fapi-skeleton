<?php

namespace App\Script\App;

use App\Script\ScriptBase;

class Test extends ScriptBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run($params)
    {
        var_dump($params); echo "\n";
    }
}