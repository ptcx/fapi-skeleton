<?php
/**
 * Predis 服务
 */
namespace App\Providers;

use App\Http\Service\PDOService;
use Pimple\Container;

class PDOProvider extends Provider
{
    /**
     * 注册到$container['db']
     * @param Container $container
     */
    public function register(Container $container)
    {
        $container['db'] = function ($container) {
            $config = $container['settings']['db'];

            $service = new PDOService($config);
            return $service;
        };
    }
}