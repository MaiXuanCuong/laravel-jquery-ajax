<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(){
        return view('admin.layout.dashboard');
    }
    public function login(){
        return view('admin.layout.login');
    }

    public function checklogin(Request $request){
    $user = $request->only('email', 'password');

        if (Auth::attempt($user)) {
            return response()->json(['success' => true, 'redirect' => route('/')]);
        } else {

            return response()->json(['success' => false, 'redirect' => route('login')]);
        }
    }
    public function logout(){
        if(Auth::logout()){
            return response()->json(['success' => true, 'message' => route('login')]);
        } else {
            return response()->json(['success' => false, 'redirect' => route('/')]);
        }
    }
    
}
