<?php

namespace App\Config;

class DBConfig {

    const DB_COMMON = [
        'driver' => 'mysql',
        'charset' => 'utf8',
        'collation' => 'utf8_general_ci',
        'prefix' => '',
    ];

    public static function getConfig()
    {
        return array_merge(self::getDBInfo(), self::DB_COMMON);
    }

    private static function getDBInfo()
    {
        $env = Config::getInstance()->env;
        return [
            'host' => $env['DB_HOST'],
            'username' => $env['DB_USERNAME'],
            'password' => $env['DB_PASSWORD'],
            'database' => $env['DB_DATABASE'],
        ];
    }

}