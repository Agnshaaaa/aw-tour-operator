<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware: AdminMiddleware
 *
 * Memproteksi route admin dari akses tanpa otorisasi.
 * Memastikan user sudah login DAN memiliki role 'admin'.
 * Jika belum login atau bukan admin, redirect ke halaman login admin dengan pesan error.
 */
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login dan merupakan admin (menggunakan helper method isAdmin() di User model)
        if (! $request->user() || ! $request->user()->isAdmin()) {
            return redirect()->route('admin.login')->with('error', 'Akses ditolak. Anda harus login sebagai Admin.');
        }

        return $next($request);
    }
}
