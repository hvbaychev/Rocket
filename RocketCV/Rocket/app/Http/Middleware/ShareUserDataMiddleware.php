<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Product;

class ShareUserDataMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Session::has('loginId')) {
            $data = User::find(Session::get('loginId'));
            view()->share('data', $data);

            // $products = Product::all();
            // view()->share('products', $products);
        }

        return $next($request);
    }
}
