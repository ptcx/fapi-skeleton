<?php

namespace App\Boot;

use App\Config\Config;
use Slim;
use App\Config\ProvidersConfig;
use App\Http\Middleware\TrailingSlashMiddleware;

class Initializer
{
    /**
     * 获取app实例
     * @return Slim\App
     */
    public function getApp()
    {
        $config = Config::getInstance()->getConfig();

        $app = new Slim\App($config);

        return $app;
    }

    /**
     * @param $app \Slim\App
     */
    public function prepareService($app)
    {
        $container = $app->getContainer();
        $this->registerAllProviders($container);
    }

    /**
     * 初始化路由
     * @param $app \Slim\App
     */
    public function prepareRoute($app)
    {
        $routeDir = Config::APP_BASE_PATH . 'routes/';
        $routeFiles = glob($routeDir . '*.php');

        self::addAppMiddleware($app);

        foreach ($routeFiles as $routeFile) {
            require $routeFile;
        }
    }

    /**
     * 注册app服务到容器
     * @param $container \Pimple\Container
     */
    private function registerAllProviders($container)
    {
        $providers = ProvidersConfig::getProviders();

        foreach ($providers as $provider) {
            $container->register(new $provider());
        }
    }

    /**
     * 添加应用中间件
     * @param $app \Slim\App
     */
    private function addAppMiddleware($app)
    {
        $app->add(new TrailingSlashMiddleware());
    }
}