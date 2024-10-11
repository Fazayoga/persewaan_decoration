<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            // Cek apakah pengguna ingin login sebagai admin atau user
            if (Str::contains($request->path(), ['dashboard'])) {
                return route('login-admin');
            } 
            
            // Check if the request is for any user-related pages
            if (Str::contains($request->path(), ['about', 'services', 'pricing', 'decor', 'contact', 'profile'])) {
                return route('login'); // User login route
            } 
            
            // Fallback to general login route
            return route('login');
        }
    }
}