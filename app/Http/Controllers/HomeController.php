<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        // dd('Hello World');
        $id = session()->get('userLogedIn');
        if ($id) {
            $user = User::find($id);
            
            $userstatus = DB::table('users')
                ->where('id', $id)
                ->value('status');
            if ($userstatus == 0 || $userstatus == 2 || $user == null) {
                Session::pull('userLogedIn');
            }

            $username= DB::table('users')
                ->where('id', $id)
                ->value('name');

            return redirect()->route('user.dashboard');
        }else
        {
            $username = null;
        }
        $userTypes = UserType::all()
        ->where('status', '=', 1);
        return view('frontend.index', compact('userTypes','username'));
    }
}
