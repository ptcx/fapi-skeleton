<?php

namespace App\Http\Controllers;

use Interop\Container\ContainerInterface;
use App\Job\TestJob;

class HelloController extends Controller
{

    /**
     * @var \App\Http\Service\HelloService $helloService
     */
    private $helloService;

    public function __construct(ContainerInterface $ci)
    {
        parent::__construct($ci);
        $this->helloService = $ci->get('service.hello');
    }

    /**
     * hello api
     *
     * @param  \Slim\Http\Request    $request  PSR7 request
     * @param  \Slim\Http\Response   $response PSR7 response
     * @param  array                 $args
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function helloApi($request, $response, $args)
    {
        return $response->withJson([
            'status' => 0,
            'message' => 'ok',
            'body' => $this->helloService->getHello(),
        ], 200);
    }

    /**
     * hello job test
     *
     * @param  \Slim\Http\Request    $request  PSR7 request
     * @param  \Slim\Http\Response   $response PSR7 response
     * @param  array                 $args
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function helloJob($request, $response, $args)
    {
        $resqueService = $this->ci->get('resque');
        $result = $resqueService->push('test', TestJob::class, ['foo' => 'bar']);
        return $response->withJson([
            'status' => 0,
            'message' => 'ok',
            'body' => $result,
        ], 200);
    }
}