<?php

namespace App\Boot;

use App\Config\Config;
use Slim;

class InitApp
{
    /**
     * 获取app实例
     * @return Slim\App
     */
    public static function getApp()
    {
        $config = Config::getInstance()->getConfig();

        $app = new Slim\App($config);

        ServiceContainer::init($app);

        Route::init($app);

        return $app;
    }
}