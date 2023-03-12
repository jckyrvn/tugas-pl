<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function show(){
        return view('auth.register');
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            "name"=>"required|unique:users|min:3",
            "email"=>"required|email|unique:users",
            "password"=>"required|min:8",
        ]);
        if($validator->fails()){
            return back()->withErrors(["message"=>"Registrasi Anda gagal!"]);
        }
        $created = User::create(array_merge($validator->validated(), ["password"=> Hash::make($request->password)]));
        return redirect()->route('auth.login');
    }

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            "email"=>"required|email",
            "password"=>"required|min:8",
        ]);
        
        if($validator->fails()){
            return back()->withErrors(["message"=>"Login Anda Gagal"]);
        }
        $user = User::where('email', $request->email)->first();
        if($user == null){
            return back()->withErrors(["message"=>"User Tidak ditemukan"]);
        }
        if(Auth::attempt($request->only('email', 'password'))){
            return redirect()->route('home');
        }
    }
    public function logout(){
            Auth::logout();

            request()->session()->invalidate();
     
            request()->session()->regenerateToken();
    
            return redirect()->route('auth.login');
    }


    public function showProfile(){
        return view('pages/profile');
    }
    public function create(){
    
    }

}
