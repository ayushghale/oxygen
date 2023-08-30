<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Stringable;

class UserAuthController extends Controller
{
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

    public function registerUser(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'contact_number' => 'required | min:10 | max:10 | unique:users',
                'email' => 'required | email | unique:users',
                'password' => 'required',
                'conform_password' => 'required | same:password',
                'address' => 'required',
                'user_type_id' => 'required',
            ]);
            if ($validate->fails()) {
                // Return JSON response with errors and HTTP status code 422 (Unprocessable Entity)
                return response()->json([
                    'success' => false,
                    'message' => 'User not registered',
                    'errors' => $validate->errors(),
                ], 422);
            }
            // user input data
            $user_email = $request->email;
            $user_contact_number = $request->contact_number;
            $user_password = $request->password;
            $user_c_password = $request->conform_password;


            $user = new User();
            $user->user_type_id = $request->user_type_id;
            $user->name = ucfirst($request->name);
            $user->address = $request->address;
            $user->email = strtolower($user_email);
            $user->contact_number = $user_contact_number;
            $user->password = Hash::make($user_password);
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'user registered successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'user not registered',
                'error' => $e->getMessage(),
            ]);
            // return redirect()->back()->with('success','User Registered Successfully');
        }
    }

    public function loginUser(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'invalid user data',
                'errors' => $validate->errors(),
            ], 422);
        }
        try {
            $user = User::where('email', '=', $request->email)->first();
            if ($user) {
                // dd($user);
                if ($user->status == 0) {
                    // dd('inactive');
                    return response()->json([
                        'success' => false,
                        'message' => 'User Account is not active',
                        'errors' => 'User Account is not active',
                    ], 403);
                }
                if (Hash::check($request->password, $user->password)) {
                    $request->session()->put('userLogedIn', $user->id);
                    // return redirect()->to('dashboard');
                    return response()->json([
                        'success' => true,
                        'message' => 'User dashboard loged in',
                        'session' => session()->get('userLogedIn')
                    ]);
                } else {
                    // return redirect()->back()->with('fail','Incorrect Password');
                    return response()->json([
                        'success' => false,
                        'message' => 'Please enter correct password',
                        'errors' => 'Incorrect Password',

                    ], 401);
                }
            } else {
                // return redirect()->back()->with('fail','No Account Found for this Email');
                return response()->json([
                    'success' => false,
                    'message' => 'Account not found for this Email',
                    'errors' => 'Email not found',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not registered',
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function logout()
    {
        if (Session::has('userLogedIn')) {
            Session::pull('userLogedIn');
            return redirect()->to('/');
        }
    }

    public function forgetPassword()
    {
        return view('customer.auth.forgetpassword');
    }
    public function changepassword()
    {
        return view('customer.auth.changepassword');
    }

    public function forgetPasswordData(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        
        $email = strtolower($request->input('email'));
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('message', 'This email is not registered yet!');
        }

        $request->session()->put('sessionUserEmail', $user->email);
        $request->session()->save();

        $data = [
            'url' => route('user.changepassword'),
            'email' => $email,
        ];

        Mail::send('email.forgetPassword', $data, function ($message) use ($data) {
            $message->to($data['email']);
            $message->from(env('MAIL_USERNAME'));
            $message->subject('Password Reset Link form Oxygen ');
        });

        return redirect('/')->with('message', 'Please check your email for password reset instructions.');
    }
   

    public function otpPage($token)
    {
        return view('customer.auth.otpCode', ['token' => $token]);
    } 

    public function resetPasswordOtpData(Request $request,$token)
    {
        $request->validate([
            'otp' => 'required',
        ]);

        $code= $request->otp;

        $token = DB::table('password_reset_tokens')->where('token', '=', $code)->first();
        dd($token);
        if (!$token) {
            return redirect()->back()->with('error', 'Invalid token');
        }
        return view('customer.auth.resetpasswordotp', ['token' => $token]);
    }
}
