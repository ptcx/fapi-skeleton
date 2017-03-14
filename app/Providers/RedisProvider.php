<?php
/**
 * Predis 服务
 */
namespace App\Providers;

use Pimple\Container;
use Predis\Client;

class RedisProvider extends Provider
{
    /**
     * 注册到$container['redis']
     * @param Container $container
     */
    public function register(Container $container)
    {
        $container['redis'] = function ($container) {
            $redisConfig = $container['settings']['redis'];

            $client = new Client([
                'scheme' => $redisConfig['scheme'],
                'host' => $redisConfig['host'],
                'port' => $redisConfig['port'],
            ]);

            return $client;
        };
    }
}