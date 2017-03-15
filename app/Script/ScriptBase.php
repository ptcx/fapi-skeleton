<?php
/**
 * 所有运行脚本均需继承此基类
 */
namespace App\Script;

use App\Boot\InitApp;

abstract class ScriptBase
{
    protected $app;

    /**
     * ScriptBase constructor. 加载app实例
     */
    public function __construct()
    {
        $this->app = InitApp::getApp();
    }

    /**
     * 主逻辑
     * @param array $params
     * @return mixed
     */
    abstract public function run($params);
}