<?php
/**
 * 模板 服务
 */
namespace App\Providers;

use Pimple\Container;
use Slim\Views\PhpRenderer;

class ViewProvider extends Provider
{
    /**
     * 注册到$container['view']
     * @param Container $container
     */
    public function register(Container $container)
    {
        $container['view'] = function ($container) {
            $config = $container['settings']['view'];

            $viewPath = $config['path'];
            $service = new PhpRenderer($viewPath);

            return $service;
        };
    }
}