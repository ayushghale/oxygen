<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmailVerification;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PharIo\Manifest\Email;
use Stringable;

class UserAuthController extends Controller
{
    /**
     *  user login page
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
     *  user type
     */
    public function userType()
    {
        $userTypes = UserType::all()
            ->where('status', '=', 1);

        return $userTypes;
    }

    /**
     *  otp code generate
     */
    public function otpCodeGenerate(){
        $otpCode = rand(1000, 9999);
        $exist = EmailVerification::where('token', $otpCode)->first();

        if($otpCode){
            $this->otpCodeGenerate();
        }else{
            return $otpCode;
        }

    }

    /**
     *  register user
     */
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

    /**
     *  login user
     */
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

    /**
     *  logout user
     */
    public function logout()
    {
        if (Session::has('userLogedIn')) {
            Session::pull('userLogedIn');
            return redirect()->to('/');
        }
    }

    // ==========================================================================================================================
    // forget password

    /**
     *  forget password page
     */
    public function forgetPassword()
    {
        $userTypes = $this->userType();
        return view('frontend.auth.forgetpassword', compact('userTypes'));
    }

    /**
     *  change password page
     */
    public function changepassword()
    {
        $userTypes = $this->userType();
        return view('frontend.auth.changepassword', compact('userTypes'));
    }

    /**
     *  forget password data
     */
    public function forgetPasswordData(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email | exists:users,email',
            ]);


            $email = strtolower($request->input('email'));
            $user = User::where('email', $email)->first();


            $request->session()->put('ForgetUserEmail', $email);
            $request->session()->save();

            $otpCode = $this->otpCodeGenerate();

            $tcode = $this->generateUniqueID();

            $userEmail= EmailVerification::where('email', $email)->first();

            if(!$userEmail){
                $forgetPassword = new EmailVerification();
                $forgetPassword->email = $email;
                $forgetPassword->token = $otpCode;
                $forgetPassword->save();
            }else{
                $userEmail->token = $otpCode;
                $userEmail->save();
            }

            session()->put('ForgetUserEmail', $email);
            session()->save();
            $data = [
                'otpCode' => $otpCode,
                'email' => $email,
            ];

            Mail::send('email.forgetPassword', $data, function ($message) use ($data) {
                $message->to($data['email']);
                $message->from(env('MAIL_USERNAME'));
                $message->subject('Password Reset Link form Oxygen ');
            });

            return redirect()->route('user.otpPage')->with('message', 'Please check your email for password reset instructions.');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     *  otp page 
     */
    public function otpPage()
    {
        $userTypes = $this->userType();
        return view('frontend.auth.otp', compact('userTypes'));
    }

    /**
     *  otp data data
     */
    public function resetPasswordOtpData(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'first' => 'required',
            'second' => 'required',
            'third' => 'required',
            'fourth' => 'required',
        ]);

        $code = $request->first . $request->second . $request->third . $request->fourth;

        

        $email = session()->get('ForgetUserEmail');

        $user = EmailVerification::where('email', $email)->first();
        
        if ($user->token != $code) {
            dd('invalid');
            return redirect()->back()->with('error', 'Invalid token');
        }

        $user->delete();

        return redirect()->route('user.resetPassword')->with('message', 'Please enter your new password');
    }

    /**
     *  reset password page
     */
    public function resetPassword ()
    {
        $userTypes = $this->userType();
        return view('frontend.auth.changePassword', compact('userTypes'));
    }

    /**
     *  reset password data
     */
    public function resetPasswordData(Request $request)
    {
        try{
        $request->validate([
            'password' => 'required | same:conform_password',
            'conform_password' => 'required | same:password',
        ]);

        $email = session()->get('ForgetUserEmail');

        $user = User::where('email', $email)->first();

        $user->password = Hash::make($request->password);
        $user->save();

        session()->forget('ForgetUserEmail');

        return redirect()->to('/')->with('message', 'Password changed successfully');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Password not changed');
        }
    }
}
