<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $redirectTo = 'user/dashboard';
    protected $username;

    public function __construct()
    {
        $this->middleware('guest')->except('logout', 'logoutGet');
        $this->username = $this->findUsername();
    }

    public function showLoginForm()
    {
        $data["page_title"] = "Login";
        return view('user.auth.login', $data);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        return $this->authenticated($request);
    }

    protected function validateLogin(Request $request)
    {
        $validation_rule = [
            $this->username() => 'required|string',
            'password' => 'required|string'
        ];

        $request->validate($validation_rule);
    }

    public function authenticated($request)
    {
        $credentials = $request->only($this->username(), 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            $user = auth()->user();

            if ($user->status == 0) {
                Auth::guard('web')->logout();
                return back()->withError('Your account has been deactivated.');
            }

            return redirect()->route('user.home');
        }

        return back()->withError('User not found.');
    }

    public function findUsername()
    {
        $login = request()->input('username');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$fieldType => $login]);
        return $fieldType;
    }

    public function username()
    {
        return $this->username;
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login')->withSuccess('You have been logged out.');
    }
}
