## 新建脚本类

所有运行脚本类需要继承`ScriptBase`这个类，这个类提供了app实例的初始化，用以获取service或配置信息。

运行脚本类需实现`run($param)`方法，`$param`是传递的命令行参数。

例如App文件夹下的`Test.php`：

```php
<?php

namespace App\Script\App;

use App\Script\ScriptBase;

class Test extends ScriptBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run($params)
    {
        var_dump($params); echo "\n";
    }
}
```
## 运行脚本

使用`ScriptRunner.php`来运行脚本类，会自动调用脚本类的run方法，并将参数解析后通过$param参数传入。

其中，命令行参数会被自动解析为数组形式传入run方法，命令行参数支持`--key=value`以及`--foo`两种形式，例如运行Test脚本类：

```shell
$ php ScriptRunner.php App/Test --key=value --foo

array(2) {
  'key' => string(5) "value"
  'foo' => bool(true)
}
```

## 运行php-resque队列消费脚本

使用`QueueProcess`脚本类来消费队列:

```shell
$ php ScriptRunner.php App/QueueProcess --queue=test
```

参数`--queue={Queue}`必须指定，可选参数为:

* 日志模式: 默认无日志，`--verbose`普通模式，`--vverbose`详细模式
* 运行间隔：多少秒检测一次队列，默认5秒，`--interval=5`
