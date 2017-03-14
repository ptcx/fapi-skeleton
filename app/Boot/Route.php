<?php

namespace App\Boot;

use App\Config\Config;
use App\Http\Middleware\TrailingSlashMiddleware;

class Route
{
    /**
     * 初始化路由
     * @param $app \Slim\App
     */
    public static function init($app)
    {
        $routeDir = Config::APP_BASE_PATH . 'routes/';
        $routeFiles = glob($routeDir . '*.php');

        self::addAppMiddleware($app);

        foreach ($routeFiles as $routeFile) {
            require $routeFile;
        }
    }

    /**
     * 添加应用中间件
     * @param $app \Slim\App
     */
    private static function addAppMiddleware($app)
    {
        $app->add(new TrailingSlashMiddleware());
    }

}