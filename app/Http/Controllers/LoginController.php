<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request){
        
        $credentials= $request->validate([
            'email'=>'required|email:dns',
            'password'=>'required'
        ]);

       if (Auth::attempt($credentials)){
           $request->session()->regenerate();
           return redirect()->intended('/');
       }
       return back()->with('loginError','Login failed');
    }
    
    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
    public function indexRegister()
    {
        return view('signup');
    }
    public function register(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email:dns',
            'password'=>'required'
        ]);
        User::create(
            ['name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
            ]
        );
        
        return redirect('/login');
    }
    

}
