<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlockCountriesByIp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $requestIp = $request->ip();
        if(in_array($requestIp, ['::1', '127.0.0.1'])) {
            Log::debug('Local host is always accepted', [$requestIp]);
            return $next($request);
        }

        $allowedCountries = ['Israel'];//config('app.allowed_countries');
        try {
            $ipInfo = json_decode(file_get_contents("http://ip-api.com/json/{$requestIp}?fields=status,message,country,countryCode"), true);
        } catch (\Exception $e) {
            $ipInfo = null;
            Log::error("Failed to get ip info for ip: {$requestIp}, error: {$e->getMessage()}");
        }


        $request->countryIpInfo = [
            'info' => $ipInfo,
            'ip' => $requestIp
        ];
        Log::debug('ip info: ', $request->countryIpInfo);

        if(!isset($ipInfo['country']) || !in_array($ipInfo['country'], $allowedCountries)) {
            $request->countryIpInfo['isBlocked'] = true;
            return abort(503); //redirect('/welcome');
        }

        return $next($request);
    }
}
