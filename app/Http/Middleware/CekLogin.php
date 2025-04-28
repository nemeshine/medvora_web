<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CekLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('id_staff')) {
            return redirect('/'); 
        }
        return $next($request); 
    }
}
