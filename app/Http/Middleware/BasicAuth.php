<?php

namespace App\Http\Middleware;

use Closure;

class BasicAuth
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * BasicAuth constructor.
     */
    public function __construct()
    {
        $this->username = config('basic-auth.username');
        $this->password = config('basic-auth.password');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($request->getUser() !== $this->username || $request->getPassword() !== $this->password) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}
