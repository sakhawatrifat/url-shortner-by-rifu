<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserVerify;
use App\Mail\ResetUserPassword;
use App\Mail\UserMailVerification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserAuthController extends Controller
{

    public function registerForm()
    {
        if(Auth::guard('web')->user()){
            return redirect(route('user.profile'));
        }
        return view('auth.user.register');
    }

    public function register(Request $request)
    {
        if(Auth::guard('web')->user()){
            return redirect(route('user.profile'));
        }
        $request->validate([
            'name' => 'required|max:255',
            //'image' => 'nullable|mimes:jpeg,jpg,png,gif',
            'email' => 'required|max:255|email|unique:users',
            'password' => 'required|confirmed|min:8|max:255',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $token = Str::random(64);

        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);

        $user['token'] = $token;
        if(env('MAIL_USERNAME') != null || env('MAIL_USERNAME') != ''){
            try {
                Mail::to($request->email)->send(new UserMailVerification($user));
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }

        return redirect(route('user.profile'))->with([
            'success' => 'Account Created. Please Check Your Mail & Verify Your Account.'
        ]);
    }

    public function verificationNotice()
    {
        if(Auth::guard('web')->user() && Auth::guard('web')->user()->email_verified_at != null){
            return redirect(route('user.profile'));
        }
        //dd(Auth::guard('web')->user());
        return view('auth.user.verification-notice');
    }

    public function verificationResend()
    {
        if(Auth::guard('web')->user()  && Auth::guard('web')->user()->email_verified_at != null){
            return redirect(route('user.profile'));
        }
        $token = Str::random(64);

        $user = Auth::guard('web')->user();
        UserVerify::where('user_id', $user->id)->delete();
        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);

        $user['token'] = $token;
        if(env('MAIL_USERNAME') != null || env('MAIL_USERNAME') != ''){
            try {
                Mail::to($user->email)->send(new UserMailVerification($user));
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }

        return back()->with([
            'success' => 'Verification Link Send To Following Mail. Please Check Your Mail & Verify Your Account.'
        ]);
    }

    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';

        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;

            if(!$user->email_verified_at) {
                $user->email_verified_at = date('Y-m-d H:i:s');
                $user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

      return redirect()->route('login')->with('message', $message);
    }

    public function loginForm()
    {
        if(Auth::guard('web')->user()){
            return redirect(route('user.profile'));
        }
        return view('auth.user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255|email',
            'password' => 'required|min:8|max:255',
        ]);

        $remember = $request->has('remember') ? true : false;

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            //return redirect(route('user.profile'));
            return redirect()->intended(route('user.profile'));
        } else {
            return back()->withErrors([
                'error' => 'User or Email is Invalid!',
            ]);
        }
    }

    public function forgotPasswordForm()
    {
        if(Auth::guard('web')->user()){
            return redirect(route('user.profile'));
        }
        return view('auth.user.passwords.email');
    }

    public function forgotPassword(Request $request)
    {
        if(Auth::guard('web')->user()){
            return redirect(route('user.profile'));
        }
        $request->validate([
            'email' => 'required|max:255|email',
        ]);

        $user = User::whereEmail($request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'error' => 'Email Not Found!',
            ]);
        }

        $permitted_chars = 'abcdefghijkl0123456789mnopqrstuvwxyz';
        $token = substr(str_shuffle($permitted_chars), 0, 7);

        DB::table('password_reset_tokens')->whereEmail($request->email)->delete();
        DB::table('password_reset_tokens')->insert([
            'email' => $user->email,
            'token' => md5($token),
            'created_at' => Carbon::now(),
        ]);

        $content = [
            'email' => $user->email,
            'token' => $token,
        ];

        if(env('MAIL_USERNAME') != null || env('MAIL_USERNAME') != ''){
            try {
                Mail::to($request->email)->send(new ResetUserPassword($content));
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }

        return redirect(route('user.password.forget.form'))->with([
            'success' => 'We have emailed your password reset link! Please wait a while and after that if do\'t get any mail try again please.'
        ]);
    }

    public function resetPasswordForm($token){
        if(Auth::guard('web')->user()){
            return redirect(route('user.profile'));
        }

        $reset = DB::table('password_reset_tokens')->where('token',md5($token))->first();
        if (!$reset) {
            return redirect(route('login'))->withErrors([
                'error' => 'Invlid Token!',
            ]);
        }

        return view('auth.user.passwords.reset');
    }

    public function resetPassword(Request $request){
        if(Auth::guard('web')->user()){
            return redirect(route('user.profile'));
        }

        $request->validate([
            'email' => 'required|max:255|email',
            'password' => 'required|min:8|max:255|confirmed',
        ]);

        $user = User::whereEmail($request->email)->first();
        if (!$user) {
            return back()->withErrors([
                'error' => 'Email Not Found!',
            ]);
        }

        $reset = DB::table('password_reset_tokens')->where('email', $request->email)->where('token',md5($request->token))->first();
        if (!$reset) {
            return back()->withErrors([
                'error' => 'Invlid Token!',
            ]);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        DB::table('password_reset_tokens')->whereEmail($request->email)->delete();

        return redirect(route('login'))->with([
            'message' => 'Your password has been changed.Login to continue.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect(route('login'));
    }
}
