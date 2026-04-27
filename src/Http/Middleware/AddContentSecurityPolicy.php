<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddContentSecurityPolicy
{
    /**
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (config('app.env') !== 'production') {
            return $response;
        }

        $policy = config('csp.policy');

        if (! is_string($policy) || $policy === '') {
            return $response;
        }

        if ($response->headers->has('Content-Security-Policy')) {
            return $response;
        }

        $response->headers->set('Content-Security-Policy', $this->normalizePolicy($policy));

        return $response;
    }

    private function normalizePolicy(string $policy): string
    {
        return preg_replace('/\s+/', ' ', trim($policy)) ?? trim($policy);
    }
}
