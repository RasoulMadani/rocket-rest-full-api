<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
    // شخصی سازی متد اوتنتیکیت سنتکام با باز نویسی این متد 
    // حتما باید از ابورت و یا اکسپشن در این متد استفاده کنیم تا برنامه بیاید بیرون
    // و الا جلوگیری نخواهد کرد 
    protected function unauthenticated($request, array $guards)
    {
        abort(response()->json([
            'message' => 'allah'
        ]));
    }
}
