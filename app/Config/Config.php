<?php

namespace App\Config;

class Config
{
    /**
     * @var string app根目录
     */
    const APP_BASE_PATH = __DIR__ . '/../';

    const DEVELOPMENT = 'development';
    const TEST = 'test';
    const PRODUCTION = 'production';

    private static $instance;

    public $env;

    /**
     * 单例，只有一个Config
     * @return Config
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private function __construct()
    {
    }

    public function getConfig()
    {
        $this->env = $this->getEnv();
        $configType = $this->env['ENV'];
        $method = $configType . 'Config';
        if (method_exists($this, $method)) {
            return [
                'settings' => $this->$method()
            ];
        } else {
            // throw exception
        }
    }

    /**
     * 从.env文件中获取配置
     * @return array
     */
    private function getEnv()
    {
        $envFile = self::APP_BASE_PATH . '.env';
        $envItems = file($envFile);
        $env = [];
        foreach ($envItems as $envItem) {
            $envItem = trim($envItem);
            if (strpos($envItem, '#') === 0 || $envItem == '') {
                continue;
            }
            list($key, $value) = explode('=', $envItem, 2);
            $env[trim($key)] = trim($value);
        }
        return $env;
    }

    /**
     * @return array 开发环境
     */
    private function developmentConfig()
    {
        return [
            'displayErrorDetails' => true,
            'db' => DBConfig::getConfig(),
            'redis' => RedisConfig::getConfig(),
            'view' => TwigViewConfig::getConfig(),
            'resque' => ResqueConfig::getConfig(),
        ];
    }

    /**
     * @return array 测试环境
     */
    private function testConfig()
    {
    }

    /**
     * @return array 生产环境
     */
    private function productionConfig()
    {
        return [
            'displayErrorDetails' => false,
            'routerCacheFile' => self::APP_BASE_PATH . 'storage/route.cache',
            'db' => DBConfig::getConfig(),
            'redis' => RedisConfig::getConfig(),
            'view' => TwigViewConfig::getConfig(),
            'resque' => ResqueConfig::getConfig(),
        ];
    }

}