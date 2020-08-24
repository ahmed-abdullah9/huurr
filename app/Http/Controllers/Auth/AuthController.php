<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Input;
use App\User;
use Validator;
use Redirect;
use Session;
use Hash;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

//use AuthenticatesAndRegistersUsers,
//   ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        return User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
        ]);
    }

    function getLogin() {
        //Session::put(['error' => '']);
        return view('controlpanel.login');
    }

    function verifyLogin() {
        //Session::put(['error' => '']);
        return view('controlpanel.verify-login');
    }

    public function postLogin(Request $request) {
        if ($request->input('username') != '' && $request->input('password') != '') {
            $userName = $request->input('username');
            $userPass = md5($request->input('password'));

            $userdata = DB::table("admin_user_tbl")
                    ->where('email', $userName)
                    ->where('password', $userPass)
                    ->get();
            if (sizeof($userdata) > 0) {
                Session::put([
                    'login_id' => $userdata[0]->id,
                    'level' => 'admin'
                ]);
                return redirect('dashboard');
            } else {
                $userdata = DB::table("brand_user_tbl")
                        ->where('email', $userName)
                        ->where('password', $userPass)
                        ->get();
                if (sizeof($userdata) > 0) {
                    $status = $userdata[0]->status;
                    if ($status == 0):
                        Session::put([
                            'login_id' => $userdata[0]->id,
                            'brand_id' => $userdata[0]->brand_name,
                            'level' => 'buser',
                            'status' => 0
                        ]);
                        return redirect('profile-edit');
                    else:
                        Session::put([
                            'login_id' => $userdata[0]->id,
                            'brand_id' => $userdata[0]->brand_name,
                            'level' => 'buser',
                            'status' => 1
                        ]);
                        return redirect('dashboard');
                    endif;
                } else {
                    $request->session()->flash('error_message', "&nbsp;&nbsp;Unauthorized Email ID or Password!!!");
                    return view('controlpanel/login');
                }
            }
        }
    }

    public function getLogout() {
        Session::put([
            'user_login_id' => '',
            'login_id' => '',
            'brand_id' => ''
        ]);
        return redirect('login')->send();
    }

}
