<?php
/**
 * monolog 服务
 */
namespace App\Providers;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Pimple\Container;

class LogProvider extends Provider
{
    /**
     * 注册到$container['applog']
     * @param Container $container
     */
    public function register(Container $container)
    {
        $container['appLog'] = function ($container) {
            $config = $container['settings']['appLog'];

            $logger = new Logger($config['name']);
            $minimumLevel = isset($config['minimumLevel']) ? $config['minimumLevel'] : Logger::DEBUG;
            $handler = new StreamHandler($config['file'], $minimumLevel);
            $logger->pushHandler($handler);

            return $logger;
        };
    }
}