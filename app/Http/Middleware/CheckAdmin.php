<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // التأكد إن اليوزر مسجل دخول ودوره admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // لو مش أدمن، يرجعه للصفحة الرئيسية مع رسالة تحذير
        return redirect('/')->with('error', 'غير مصرح لك بدخول لوحة تحكم الأدمن.');
    }
}
