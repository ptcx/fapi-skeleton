<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Boot\InitApp;

$app = InitApp::getApp();
$app->run();
