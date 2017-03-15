<?php

namespace App\Config;

class ResqueConfig
{

    public static function getConfig()
    {
        $env = Config::getInstance()->env;

        $server = $env['REDIS_HOST'] . ':' . $env['REDIS_PORT'];

        return [
            'server' => $server,
        ];
    }
}