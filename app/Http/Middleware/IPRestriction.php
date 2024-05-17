<?php

namespace App\Http\Middleware;

use App\Helpers\Helper;
use App\Models\IpRestriction as ModelsIpRestriction;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Symfony\Component\HttpFoundation\Response;

class IPRestriction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
  
    public function handle(Request $request, Closure $next): Response
    {
        $ipAddress = $request->ip();
        $ipRestriction = ModelsIpRestriction::where('ip_address', $ipAddress)->where('is_active', true)->first();
        if ($ipRestriction) {
            return $next($request);
        } else {
            return redirect()->route('login')->with('error', 'You are not allowed to access this page.')->withInput();
        }

    }
}
