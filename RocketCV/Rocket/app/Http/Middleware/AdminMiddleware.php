<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('loginId')) {
            return redirect()->back()->with('fail', 'You have to login as an administrator.');
        }

        $data = User::find(Session::get('loginId'));

        if ($data->role !== 'admin') {
            return redirect()->back()->with('fail', 'You have to login as an administrator.');
        }

        return $next($request);
    }
}
