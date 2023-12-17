<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Mail\ResetAdminPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminAuthController extends Controller
{

    public function checkAuth()
    {
        if(Auth::guard('admin')->user()){
            return redirect(route('admin.home'));
        }
    }

    public function loginForm()
    {
        $this->checkAuth();
        return view('auth.admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255|email',
            'password' => 'required|min:8|max:255',
        ]);

        $remember = $request->has('remember') ? true : false;

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            //return redirect(route('admin.home'));
            return redirect()->intended(route('admin.home'));
        } else {
            return back()->withErrors([
                'error' => 'User or Email is Invalid!',
            ]);
        }
    }

    public function forgotPasswordForm()
    {
        $this->checkAuth();
        return view('auth.admin.passwords.email');
    }

    public function forgotPassword(Request $request)
    {
        $this->checkAuth();
        $request->validate([
            'email' => 'required|max:255|email',
        ]);

        $user = Admin::whereEmail($request->email)->first();

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
                Mail::to($request->email)->send(new ResetAdminPassword($content));
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }

        return redirect(route('admin.password.forget.form'))->with([
            'success' => 'We have emailed your password reset link! Please wait a while and after that if do\'t get any mail try again please.'
        ]);
    }

    public function resetPasswordForm($token){
        $this->checkAuth();

        $reset = DB::table('password_reset_tokens')->where('token',md5($token))->first();
        if (!$reset) {
            return redirect(route('admin.login'))->withErrors([
                'error' => 'Invlid Token!',
            ]);
        }

        return view('auth.admin.passwords.reset');
    }

    public function resetPassword(Request $request){
        $this->checkAuth();

        $request->validate([
            'email' => 'required|max:255|email',
            'password' => 'required|min:8|max:255|confirmed',
        ]);

        $user = Admin::whereEmail($request->email)->first();
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

        return redirect(route('admin.login'))->with([
            'success' => 'Your password has been changed.Login to continue.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }
}
