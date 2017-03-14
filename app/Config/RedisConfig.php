<?php

namespace App\Config;

class RedisConfig
{
    public static function getConfig()
    {
        $env = Config::getInstance()->env;
        return [
            'scheme' => $env['REDIS_SCHEME'],
            'host' => $env['REDIS_HOST'],
            'port' => $env['REDIS_PORT'],
        ];
    }
}