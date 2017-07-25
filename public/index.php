<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Boot\Initializer;

$initializer = new Initializer();

$app = $initializer->getApp();

$initializer->prepareService($app);

$initializer->prepareRoute($app);

$app->run();
