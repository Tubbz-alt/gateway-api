<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class IpFilter
 * @package App\Http\Middleware
 */
class IpFilter
{
    /**
     * @var array
     */
    private $allowedIpAddresses;

    /**
     * @var array
     */
    private $allowedNetmaskSet;

    /**
     * IpFilter constructor.
     */
    public function __construct()
    {
        $this->allowedIpAddresses = config('access.ip', []);
        $this->allowedNetmaskSet = config('access.netmask', []);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $isAllowedIp = in_array($request->ip(), $this->allowedIpAddresses);
        $isIpInAllowedNetmaskSet = $this->ipMatchesAllowedNetmaskSet($request->ip());

        if (! $isAllowedIp && ! $isIpInAllowedNetmaskSet) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }

    /**
     * @param string $ip
     * @return bool
     */
    private function ipMatchesAllowedNetmaskSet(string $ip): bool
    {
        $doesMatch = false;

        foreach ($this->allowedNetmaskSet as $netmask) {
            $doesMatch = $doesMatch || $this->ipExistsInRange($ip, $netmask);
        }

        return $doesMatch;
    }

    /**
     * Check if given IP address is in a network.
     *
     * @link https://gist.github.com/tott/7684443
     *
     * @param string $ip    IP to check in IPV4 format eg. 127.0.0.1
     * @param string $range IP/CIDR netmask eg. 127.0.0.0/24, also 127.0.0.1 is accepted and /32 assumed
     *
     * @return bool true if the IP address is in this range / false if not.
     */
    private function ipExistsInRange(string $ip, string $range): bool
    {
        if (strpos($range, '/') === false) {
            $range .= '/32';
        }

        list($range, $netmask) = explode('/', $range, 2);

        $rangeDecimal = ip2long($range);
        $ipDecimal = ip2long($ip);

        $wildcardDecimal = pow( 2, ( 32 - $netmask ) ) - 1;
        $netmaskDecimal = ~ $wildcardDecimal;

        return ( ($ipDecimal & $netmaskDecimal) == ($rangeDecimal & $netmaskDecimal) );
    }
}
