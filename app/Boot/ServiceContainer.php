<?php

namespace App\Boot;

use App\Config\AppConfig;

class ServiceContainer
{

    /**
     * @param $app \Slim\App
     */
    public static function init($app)
    {
        $container = $app->getContainer();
        self::registerAllProviders($container);
    }

    /**
     * 注册app服务到容器
     * @param $container \Pimple\Container
     */
    private static function registerAllProviders($container)
    {
        $providers = AppConfig::getProviders();

        foreach ($providers as $provider) {
            $container->register(new $provider());
        }
    }

}
