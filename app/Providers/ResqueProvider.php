<?php
/**
 * php-resque 服务
 */
namespace App\Providers;

use Pimple\Container;
use App\Http\Service\ResqueService;

class ResqueProvider extends Provider
{
    /**
     * 注册到$container['resque']
     * @param Container $container
     */
    public function register(Container $container)
    {
        $container['resque'] = function ($container) {
            $config = $container['settings']['resque'];

            $server = $config['server'];
            $passwd = isset($config['password']) ? $config['password'] : '';
            $database = isset($config['database']) ? $config['database'] : 0;

            $service = new ResqueService($server, $passwd, $database);
            return $service;
        };
    }
}