<?php
/**
 * 跨站ajax中间件
 */
namespace App\Http\Middleware;

class CorsMiddleware
{
    /**
     * @var array 允许跨站的url array，['*']表示允许所有
     */
    protected $origin;

    /**
     * @var string
     */
    protected $headers;

    /**
     * @var array 允许的方法 eg. ['GET', 'POST']
     */
    protected $methods;

    /**
     * CorsMiddleware constructor.
     * @param $origin array
     * @param $methods array
     */
    public function __construct($origin, $methods)
    {
        $this->origin = $origin;
        $this->methods = $methods;
        $this->headers = 'X-Requested-With, Content-Type, Accept, Origin, Authorization';
    }

    /**
     * 允许跨站ajax
     *
     * @param  \Slim\Http\Request       $request  PSR7 request
     * @param  \Slim\Http\Response      $response PSR7 response
     * @param  callable                 $next     Next middleware
     *
     * @return \Slim\Http\Response
     */
    public function __invoke($request, $response, callable $next)
    {
        $response = $next($request, $response);
        $originUrl = $request->getHeader('HTTP_ORIGIN');
        if (empty($originUrl)) {
            return $response;
        }
        $method = $request->getMethod();
        if ((in_array('*', $this->origin) || in_array($originUrl[0], $this->origin))
            && in_array($method, $this->methods)) {
            return $response
                ->withHeader('Access-Control-Allow-Origin', $originUrl)
                ->withHeader('Access-Control-Allow-Headers', $this->headers)
                ->withHeader('Access-Control-Allow-Methods', $method);
        }
        return $response;
    }
}