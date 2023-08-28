<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = session()->get('adminLogedIn');

        $adminType = DB::table('admins')
            ->where('id', $id)
            ->value('admin_type');

        if ($adminType == 1) {
            if ($id) {
                $user = Admin::find($id);
                $userstatus = DB::table('admins')
                    ->where('id', $id)
                    ->value('status');
                if ($userstatus == '0' || $user == null) {
                    Session::pull('userLogedIn');
                    return redirect()->to('/');
                }
            }

            // Check if the 'userLogedIn' session variable does not exist or its value is null

            if (!$request->session()->has('adminLogedIn') && ($request->path() != 'admin/login' && $request->path() != 'admin/register')) {

                return redirect()->to('/');
            }
        } else {
            return redirect()->to('/');
        }
        return $next($request);
    }
}
