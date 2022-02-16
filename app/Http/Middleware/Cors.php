<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
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
        // return $next($request)
        //     ->header('Access-Control-Allow-Origin', '*')
        //     ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS')
        //     ->header('Access-Control-Allow-Headers', 'Accept, Content-Type, Authorization');
        $response = $next($request);
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods','GET, POST, PUT, PATCH, DELETE, OPTIONS',
            'Access-Control-Allow-Headers','Accept, Content-Type, Authorization',
        ];

        foreach($headers as $key => $value) {
            $response->headers->set($key, $value);
        }

        return $response;
    }
}
