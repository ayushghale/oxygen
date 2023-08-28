<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    /**
     * Generate unique transaction code
     */
    public function generateUniqueID()
    {
        $today = date('YmdHi');
        $startDate = date('YmdHi', strtotime('-10 days'));
        $range = $today - $startDate;
        $rand = rand(0, $range);
        $uniqueID = $startDate + $rand;
        $length = 20;
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $sid = substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
        $sid = $sid . $uniqueID;

        return $sid;
    }

    /**
     * Show users
     */
    public function login()
    {

        return view('adminAuth.login');

        return response()->json([
            'success' => true,
            'message' => 'admin Login page',
        ]);
    }
    public function register()
    {

        return view('adminAuth.register');

        return response()->json([
            'success' => true,
            'message' => 'admin register page',
        ]);
    }

    /**
     * admin register credentials
     */
    public function adminRegister(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'full_name' => 'required',
            'contact_number' => 'required | integer | min:10',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required',
            'confirm_Password' => 'required | same:password',
        ]);
        // dd('validation passed');
        try {
            $admin = new Admin();
            $admin->name = $request->full_name;
            $admin->contact_number = $request->contact_number;
            $admin->email = $request->email;
            $admin->password = Hash::make($request->password);
            $admin->save();
             return redirect()->to('admin/login');
            return response()->json([
                'success' => true,
                'message' => 'Admin Registered Successfully',
                'data' => $admin,
            ]);
            // return redirect()->back()->with('success','Admin Registered Successfully');

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Admin Registration Failed',
                'error' => $e->getMessage(),
            ]);
            // return redirect()->back()->with('fail','Admin Registration Failed');
        }
    }

    /**
     * admin login credentials
     */
    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $inputEmail = $request->email;
        $inputPassword = $request->password;
        try {
            $admin = Admin::where('email', '=', $inputEmail)->first();

            $adminType = $admin->admin_type;

            if ($adminType === 1) {
                // dd('admin');
                if (Hash::check($request->password, $admin->password)) {
                    $request->session()->put('adminLogedIn', $admin->id);
                    return redirect()->to('admin/dashboard');
                    // return response()->json([
                    //     'success' => true,
                    //     'message' => 'User dashboard loged in',
                    //     'session' => session()->get('adminLogedIn')
                    // ]);
                } else {
                    return redirect()->back()->with('fail','Incorrect Password');
                    // return response()->json([
                    //     'success' => false,
                    //     'message' => 'user incorrect password',
                    // ]);
                }
            } elseif ($adminType === 0) {
                // dd('staff');
                if (Hash::check($request->password, $admin->password)) {
                    $request->session()->put('staffLogedIn', $admin->id);
                    return redirect()->to('staff/dashboard');
                    // return response()->json([
                    //     'success' => true,
                    //     'message' => 'User dashboard loged in',
                    //     'session' => session()->get('staffLogedIn')
                    // ]);
                } else {
                    return redirect()->back()->with('fail','Incorrect Password');
                    // return response()->json([
                    //     'success' => false,
                    //     'message' => 'user incorrect password',
                    // ]);
                }
            } else {
                return redirect()->back()->with('fail','No Account Found for this Email');
                // return response()->json([
                //     'success' => true,
                //     'message' => 'User No Account Found for this Email',
                // ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'user not registered',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show staff dashboard.
     */
    // public function staffDashboard()
    // {
    //     dd('staff dashboard');
    //     return view('staff.dashboard');
    // }

    /**
     * Logout
     */
    public function staffLogout()
    {
        if (Session::has('staffLogedIn')) {
            Session::pull('staffLogedIn');
            return redirect()->to('/');
            return response()->json([
                'success' => true,
                'message' => 'admin log out sucessfully',
            ]);
        } else {
            return redirect()->to('/');
            return response()->json([
                'success' => false,
                'message' => 'User Login page',
            ]);
        }
    }

    /**
     * Show admin dashboard.
     */
    // public function adminDashboard()
    // {
    //     dd('admin dashboard');
    //     return view('admin.dashboard');
    // }

    /**
     * Admin Logout
     */
   
}
