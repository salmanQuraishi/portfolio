<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index(){
        return view('admin.login');
    }
    public function mylogin(){
        return view('admin.login');
    }
    public function login(Request $req){
        $req->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if(Auth::attempt($req->only('email', 'password'))){
            return redirect('admin/index');
        }else{
            return redirect()->back()->with('message', 'Email & Password not match!');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('admin/login');
    }
}