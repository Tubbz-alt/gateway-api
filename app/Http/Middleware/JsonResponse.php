<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class JsonResponse
 * @package App\Http\Middleware
 */
class JsonResponse
{
    /**
     * Handle an incoming request.
     *
     * Expected errors, that are not being reported and
     * are listed in App\Exceptions\Handler::$dontReport,
     * will be returned as response in JSON format.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
