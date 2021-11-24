<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\IPuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RestrictIpAddressMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $ipuser = IPuser::where('ip_user', $request->ip())->first();
        if (is_null($ipuser)) {
            $ipuser = IPuser::create([
                'ip_user' => $request->ip(),
                'active' => '1'
            ]);
        }
        if ($ipuser->active != '1') {
            return Redirect::to('blocked')->send();
        }
        return $next($request);
    }
}
