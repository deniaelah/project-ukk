<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function tampilRegister(){
        return view('register');
    }
    public function submitRegister(Request $request) { 
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;  
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        // dd($user);
        return redirect()->route('login');
    }
    public function tampilLogin(){
        return view('login');
    }
    public function login(Request $request){
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate(); // penting!
        return redirect()->route('dashboard');
    } else {
            return redirect()->back()->with('Gagal', 'Email atau Password Anda Salah');
        }
    }
    public function logout(){
        return view('logout');
    }
}

