<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = session()->get('userLogedIn');

        if ($id) {
            $user = User::find($id);
            $userstatus = DB::table('users')
                ->where('id', $id)
                ->value('status');
            if ($userstatus == 0 || $userstatus == 2 || $user == null) {
                Session::pull('userLogedIn');
                return redirect()->to('/');
            }
        }

        // Check if the 'userLogedIn' session variable does not exist or its value is null

        if (!$request->session()->has('userLogedIn') && ($request->path() != 'user/login' && $request->path() != 'user/register')) {

            return redirect()->to('/');
        }
        return $next($request);
    }
}
