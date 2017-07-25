<?php

return [
    'environ' => App\Config\Config::DEVELOPMENT,

    'app' => [
        'displayErrorDetails' => true,
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
];