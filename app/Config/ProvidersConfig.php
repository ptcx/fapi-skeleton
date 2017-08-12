<?php

namespace App\Config;

use App\Providers\AppServiceProvider;
use App\Providers\LogProvider;
use App\Providers\PDOProvider;
use App\Providers\RedisProvider;
use App\Providers\ResqueProvider;
use App\Providers\ViewProvider;

class ProvidersConfig
{

    /**
     * 所有的应用服务在此注册
     * @return array
     */
    public static function getProviders()
    {
        return [
            AppServiceProvider::class,
            RedisProvider::class,
            ResqueProvider::class,
            PDOProvider::class,
            LogProvider::class,
            ViewProvider::class,
        ];
    }

}
