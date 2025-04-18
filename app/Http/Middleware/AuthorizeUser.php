<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeUser
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user_role = $request->user()->getRole();  // Ambil data level_kode dari user yang login
        if (in_array($user_role, $roles)) { // Cek apakah level_kode user ada di dalam array roles
            return $next($request); // Jika ada, lanjutkan request
        }
        // Jika tidak punya role, tampilkan error 403
        abort(403, 'Forbidden. Kamu tidak punya akses ke halaman ini');
    }
}
