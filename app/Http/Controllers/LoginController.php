<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\AuthenticatesUsers;
use App\Http\Requests\LoginRequest;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use Auth;
class LoginController extends Controller
{
    public function getLogin() {
        //return view('login');
        return redirect()->route('login');
    }
    public function postLogin(LoginRequest $request) {
        $login = array(
            'email' => $request->email,
            'password' => $request->password
        );

        if (Auth::attempt($login)) {
             return redirect()->route('product.list');
        } else {
            return back();
        }
    }
    public function Logout(Request $request) {
        return view('login')->with(Auth::logout());
    }
}
