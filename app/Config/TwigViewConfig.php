<?php

namespace App\Config;

class TwigViewConfig
{
    const TEMPLATE_PATH = Config::APP_BASE_PATH . 'resource/view';
    const CACHE_PATH = Config::APP_BASE_PATH . 'storage/view';

    public static function getConfig()
    {
        $env = Config::getInstance()->env;

        if ($env['ENV'] == Config::DEVELOPMENT || $env['ENV'] == Config::TEST) {
            $enableCache = false;
        } else {
            $enableCache = true;
        }

        return [
            'templates' => self::TEMPLATE_PATH,
            'cache' => ($enableCache ? self::CACHE_PATH : false),
            'auto_reload' => $enableCache,
        ];
    }
}