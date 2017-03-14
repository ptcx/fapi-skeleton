<?php
/**
 * 应用中自定义的Service在此注册
 */
namespace App\Providers;

use App\Http\Service\HelloService;
use Pimple\Container;

class AppServiceProvider extends Provider
{
    public function register(Container $container)
    {
        $container['service.hello'] = function ($container) {
                return new HelloService();
        };
    }
}