<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ForgotPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $Email = session()->get('ForgetUserEmail');

        $userEmail = DB::table('users')
            ->where('email', $Email)
            ->value('email');
        if($userEmail == null){
            return redirect()->to('/')->with('error', 'Email not found');
        }

        return $next($request);
    }
}
