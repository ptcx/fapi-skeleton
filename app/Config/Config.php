<?php

namespace App\Config;

class Config
{
    /**
     * @var string app根目录
     */
    const APP_BASE_PATH = __DIR__ . '/../';
    const CONF_FILE = self::APP_BASE_PATH . 'conf.php';
    const APCU_KEY = 'app_conf_php';

    const DEVELOPMENT = 1;
    const TEST = 2;
    const PRODUCTION = 3;

    private static $instance;

    private $conf = [];
    private $settings = [];

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
        $this->getLocalConf();

        if (isset($this->conf['app']) && is_array($this->conf['app'])) {
            $this->settings = array_merge($this->settings, $this->conf['app']);
        }
        foreach ($this->conf as $key => $conf) {
            if ($key == 'environ' || $key == 'app') {
                continue;
            }
            $this->settings[$key] = $conf;
        }
    }

    /**
     * 返回slim app初始化时的config参数
     * @return array
     */
    public function getConfig()
    {
        return [
            'settings' => $this->settings
        ];
    }

    /**
     * 返回环境类型  self::DEVELOPMENT 或 self::TEST 或 self::PRODUCTION
     * @return int
     */
    public function getEnvironType()
    {
        return $this->conf['environ'];
    }

    /**
     * 从conf.php中获取配置，线上环境缓存apcu
     */
    private function getLocalConf()
    {
        $conf = apcu_fetch(self::APCU_KEY);
        if ($conf !== false) {
            $this->conf = $conf;
            return;
        }
        $this->conf = require self::CONF_FILE;
        if ($this->conf['environ'] == self::PRODUCTION) {
            apcu_store(self::APCU_KEY, $this->conf);
        }
    }
}