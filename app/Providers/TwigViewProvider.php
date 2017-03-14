<?php
/**
 * Twig 服务
 */
namespace App\Providers;

use Pimple\Container;
use \Slim\Views\Twig;
use \Slim\Views\TwigExtension;

class TwigViewProvider extends Provider
{
    /**
     * 注册到$container['view']
     * @param Container $container
     */
    public function register(Container $container)
    {
        $container['view'] = function ($container) {
            $viewConfig = $container['settings']['view'];

            $view = new Twig($viewConfig['templates'], [
                'cache' => $viewConfig['cache'],
                'auto_reload' => $viewConfig['auto_reload'],
            ]);

            $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
            $view->addExtension(new TwigExtension($container['router'], $basePath));

            return $view;
        };
    }
}
