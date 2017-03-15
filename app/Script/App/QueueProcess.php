<?php
/**
 * 处理消息队列
 * 参照php-resque中resque.php
 * 必须参数: queue
 * 可选参数：verbose  vverbose  interval  count
 */
namespace App\Script\App;

use App\Script\ScriptBase;

class QueueProcess extends ScriptBase
{
    private $params;

    public function __construct()
    {
        parent::__construct();
    }

    public function run($params)
    {
        $this->checkParams($params);
        $container = $this->app->getContainer();
        $resqueConfig = $container['settings']['resque'];
        \Resque::setBackend($resqueConfig['server']);
        if ($this->params['count'] > 1) {
            for($i = 0; $i < $this->params['count']; ++$i) {
                $pid = pcntl_fork();
                if($pid == -1) {
                    die("Could not fork worker ".$i."\n");
                } else if(!$pid) {
                    $this->startWorker();
                    break;
                }
            }
        } else {
            $this->startWorker();
        }
    }

    private function checkParams($params)
    {
        if (empty($params)) {
            die('参数缺失');
        }
        // queue参数  指定队列
        isset($params['queue']) or die('queue参数需要配置');
        $this->params['queues'] = explode(',', $params['queue']);
        // 日志详细情况配置
        if (isset($params['verbose'])) {
            $logLevel = \Resque_Worker::LOG_NORMAL;
        } else if(isset($params['vverbose'])) {
            $logLevel = \Resque_Worker::LOG_VERBOSE;
        } else {
            $logLevel = \Resque_Worker::LOG_NONE;
        }
        $this->params['log_level'] = $logLevel;
        // interval参数    处理时间间隔多少秒
        $this->params['interval'] = $params['interval'] ?? 5;
        // count参数    启动多少个进程
        $count = 1;
        if (isset($params['count']) && ((int)$params['count']) > 1) {
            $count = (int)$params['count'];
        }
        $this->params['count'] = $count;
    }

    private function startWorker()
    {
        $queues = $this->params['queues'];
        $worker = new \Resque_Worker($queues);
        $worker->logLevel = $this->params['log_level'];
        fwrite(STDOUT, '*** Starting worker '.$worker."\n");
        $worker->work($this->params['interval']);
    }
}