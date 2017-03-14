<?php
/**
 * url尾部斜杠中间件
 */
namespace App\Http\Middleware;

class TrailingSlashMiddleware
{
    /**
     * url尾部斜杠 全都重定向为无斜杠
     *
     * @param  \Slim\Http\Request       $request  PSR7 request
     * @param  \Slim\Http\Response      $response PSR7 response
     * @param  callable                 $next     Next middleware
     *
     * @return \Slim\Http\Response
     */
    public function __invoke($request, $response, callable $next)
    {
        $uri = $request->getUri();
        $path = $uri->getPath();
        if ($path != '/' && substr($path, -1) == '/') {
            $uri = $uri->withPath(substr($path, 0, -1));

            if($request->getMethod() == 'GET') {
                return $response->withRedirect((string)$uri, 301);
            }
            else {
                return $next($request->withUri($uri), $response);
            }
        }

        return $next($request, $response);
    }
}