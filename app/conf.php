<?php

return [
    'environ' => App\Config\Config::DEVELOPMENT,

    'app' => [
        'displayErrorDetails' => true,
    ],

    'appLog' => [
        'name' => 'appLog',
        'file' => \App\Config\Config::PROJECT_BASE_PATH . '/logs/app.log',
        'minimumLevel' => \Monolog\Logger::DEBUG,
    ],

    'db' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'port' => '3306',
        'dbname' => '',
        'charset' => 'utf8',
        'username' => '',
        'password' => '',
    ],

    'redis' => [
        'scheme' => 'tcp',
        'host' => 'localhost',
        'port' => '6379',
    ],

    'resque' => [
        'server' => 'localhost:6379',
    ],

    'view' => [
        'path' => \App\Config\Config::APP_BASE_PATH . '/view',
    ],
];