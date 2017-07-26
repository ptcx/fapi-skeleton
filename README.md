Api Skeleton based on Slim
===========================================

用于快速开发api后台的php代码骨架，基于Slim，使用composer引入常用组件。

## 包含组件

### Framework

Slim: <https://github.com/slimphp/slim>

### Database

PDO: <http://php.net/manual/en/book.pdo.php>

### Redis

Predis: <https://github.com/nrk/predis>

### Log

monolog: <https://github.com/Seldaek/monolog>

### MQ

php-resque: <https://github.com/chrisboulton/php-resque>

## 使用

```shell
$ composer create-project ptcx/fapi-skeleton [app-name]
```