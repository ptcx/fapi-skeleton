<?php
use App\Http\Middleware\CorsMiddleware;

/**
 * @var Slim\App $app
 */

$app->group('/hello', function () {

    $this->get('', 'App\Http\Controllers\HelloController:helloPage');

    $this->get('/api', 'App\Http\Controllers\HelloController:helloApi')
        ->add(new CorsMiddleware(['*'], ['GET']));

    $this->get('/job', 'App\Http\Controllers\HelloController:helloJob');
});
