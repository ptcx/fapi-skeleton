<?php

namespace App\Config;

class AppConfig
{

    /**
     * 所有的应用服务在此注册
     * @return array
     */
    public static function getProviders()
    {
        return [
            'App\Providers\OrmProvider',
            'App\Providers\RedisProvider',
            'App\Providers\TwigViewProvider',
            'App\Providers\AppServiceProvider',
        ];
    }

}
