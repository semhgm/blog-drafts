<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DraftAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // URL’den gelen Post modeli (route model binding ile)
        $post = $request->route('post');

        // Eğer taslaksa kontrol yap
        if ($post && $post->is_draft) {
            $user = $request->user();

            if (!$user || !$user->hasVerifiedEmail()) {
                abort(403, 'Taslak için giriş ve e-posta doğrulaması gerekir.');
            }
        }

        return $next($request);
    }
}
