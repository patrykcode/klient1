<?php

namespace Cms\Roles\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/start';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm() {
//        dd(\Auth::user());
        if (\Auth::guard()->check()) {
            return redirect()->route('start');
        }

        return view('roles::login');
    }

    public function logout(\Illuminate\http\Request $request) {

        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    }

}
