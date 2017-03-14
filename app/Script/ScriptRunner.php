<?php
/**
 * 用此类来运行脚本
 * eg. php ScriptRunner.php Normal/Test argv1 argv2
 */
namespace App\Script;

require __DIR__ . '/../../vendor/autoload.php';

class ScriptRunner
{
    private $argv;

    public function __construct($argv)
    {
        $this->argv = $argv;
    }

    public function runScript()
    {
        if (count($this->argv) < 2) {
            echo "没有提供需要运行的脚本名称!\neg.\nphp ScriptRunner.php Normal/Test argv1 argv2";
            exit;
        }
        $scriptClass = $this->getScriptClass($this->argv[1]);
        $scriptParam = array_slice($this->argv, 2);
        $scriptClass->run($scriptParam);
    }

    private function getScriptClass($name)
    {
        $name = str_replace('/', '\\', $name);
        $scriptName = 'App\Script\\' . $name;
        if (class_exists($scriptName)) {
            return new $scriptName();
        } else {
            echo "脚本名称不存在！";
            exit;
        }
    }
}


$scriptRunner = new ScriptRunner($argv);
$scriptRunner->runScript();