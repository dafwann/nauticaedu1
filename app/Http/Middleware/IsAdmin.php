<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
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
        // Pastikan user sudah login
        if (!$request->user()) {
            return response()->json([
                'message' => 'Unauthorized. Login required.'
            ], 401);
        }

        // Cek role admin
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Forbidden. Admin only.'
            ], 403);
        }

        return $next($request);
    }
}
