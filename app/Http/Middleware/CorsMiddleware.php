<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;

/**
 * @author  Arif Setianto <arifsetiantoo@gmail.com>
 */
class CorsMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', '*');
        $response->headers->set('Access-Control-Allow-Headers', '*');

        return $response;
    }
}
