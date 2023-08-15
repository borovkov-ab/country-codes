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
        $allowedCountries = ['Israel'];//config('app.allowed_countries');
        try {
            $ipInfo = json_decode(file_get_contents("http://ip-api.com/json/{$requestIp}?fields=status,message,country,countryCode"), true);
        } catch (\Exception $e) {
            $ipInfo = null;
            Log::error("Failed to get ip info for ip: {$requestIp}, error: {$e->getMessage()}");
        }

        Log::debug('ip info: ', [$ipInfo]);

        if(isset($ipInfo['country']) && !in_array($ipInfo['country'], $allowedCountries)) {
            $request->countryBlockedByIp = true;
            return $next($request);
        }

        //here we can redirect to a page that says that the site is not available in the country
        return $next($request);
    }
}
