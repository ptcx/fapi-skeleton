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
            die("没有提供需要运行的脚本名称!\neg.\nphp ScriptRunner.php App/Test argv1 argv2");
        }
        $scriptClass = $this->getScriptClass($this->argv[1]);
        $scriptParams = array_slice($this->argv, 2);
        $scriptClass->run($this->parseScriptParams($scriptParams));
    }

    private function getScriptClass($name)
    {
        $name = str_replace('/', '\\', $name);
        $scriptName = 'App\Script\\' . $name;
        if (!class_exists($scriptName)) {
            die("脚本名称不存在！");
        }
        return new $scriptName();
    }

    /**
     * 分解命令行参数  现在只支持--foo=bar形式  将其分解为'foo' => 'bar'
     * @param array $scriptParams 命令行参数
     * @return array
     */
    private function parseScriptParams($scriptParams)
    {
        if (empty($scriptParams)) {
            return [];
        }
        $params = [];
        foreach ($scriptParams as $param) {
            $divide = explode('=', $param, 2);
            if (substr_compare($divide[0], '--', 0, 2)) {
                die("参数仅支持--foo=bar或--foo");
            }
            $divide[0] = substr($divide[0], 2);
            if (empty($divide[0])) {
                die("参数仅支持--foo=bar或--foo");
            }
            $value = empty($divide[1]) ? true : $divide[1];
            $params[$divide[0]] = $value;
        }
        return $params;
    }
}


$scriptRunner = new ScriptRunner($argv);
$scriptRunner->runScript();