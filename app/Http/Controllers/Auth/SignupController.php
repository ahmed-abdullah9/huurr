<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Crypt;
use Hash;
use DB;

class SignupController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {
        
        /*$SaveData = DB::table('users')->insert([
            'name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => md5($request->input('password'))
        ]);*/
        die("hi");
        $SaveData = TRUE;
        if ($SaveData):
            Session::flash('success_message', ' Signup Successfully !!!');
            return Redirect::to('login');
        else :
            Session::flash('error_message', ' Signup Failed !!!');
            return Redirect::to('signup');
        endif;
    }

    public function checkUniqueEmail(Request $request) {
        $email = $request->input('value');
        $checkEmail = DB::table('brand_user_tbl')->where('email', '=', $email)->count();
        if ($checkEmail > 0):
            echo 1;
        else:
            echo 0;
        endif;
    }

}
