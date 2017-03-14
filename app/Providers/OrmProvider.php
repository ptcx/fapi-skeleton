<?php
/**
 * Eloquent ORM 服务
 */
namespace App\Providers;

use Pimple\Container;
use Illuminate\Database\Capsule\Manager;

class OrmProvider extends Provider
{
    /**
     * 注册到$container['db']
     * @param Container $container
     */
    public function register(Container $container)
    {
        $dbConfig = $container['settings']['db'];

        $capsule = new Manager();
        $capsule->addConnection($dbConfig);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        $container['db'] = $capsule;
    }
}