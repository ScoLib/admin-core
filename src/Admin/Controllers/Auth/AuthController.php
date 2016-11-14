<?php


namespace Sco\Admin\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Auth;

class AuthController extends BaseController
{
    use AuthenticatesUsers, ValidatesRequests;

    //private $maxLoginAttempts = 2;

    //private $lockoutTime = 10;

    protected $redirectTo = '/admin';

    //protected $redirectAfterLogout = 'admin/login';


    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('admin::auth.login');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $rules = [
            $this->username() => 'required',
            'password' => 'required',
        ];
        if (config('captcha.switch.admin')) {
            $rules['captcha'] = 'required|captcha';
        }
        $this->validate($request, $rules);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Log the user out of the application.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect(route('admin.login'));
    }
}