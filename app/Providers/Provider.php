<?php
/**
 * 所有ServiceProvider均需继承此基类
 */
namespace App\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

abstract class Provider implements ServiceProviderInterface
{
    abstract function register(Container $container);
}