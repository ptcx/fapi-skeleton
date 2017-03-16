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
     * hello page
     *
     * @param  \Slim\Http\Request    $request  PSR7 request
     * @param  \Slim\Http\Response   $response PSR7 response
     * @param  array                 $args
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function helloPage($request, $response, $args)
    {
        $hello = $this->helloService->getHello();
        return $this->ci->get('view')->render($response, 'hello.twig', [
            'hello' => $hello,
        ]);
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
            'message' => 'ok'
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
        $settings = $this->ci->get('settings');
        $redisServer = $settings['resque']['server'];
        $result = (new TestJob())
            ->initResque($redisServer)
            ->onQueue('test')
            ->push(['foo' => 'bar']);
        return $this->ci->get('view')->render($response, 'hello.twig', [
            'hello' => $result,
        ]);
    }
}