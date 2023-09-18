<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function getLogin(){
        return view('auth.login');
    }

    public function postLogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $validated=auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ],$request->password);

        if($validated){
            return redirect()->route('home')->with('success','Login Successfull');
        }else{
            return redirect()->back()->with('error','Invalid credentials');
        }
    }

    public function register(){
        return view('auth.register');
    }

    public function postRegister(){
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::create(request(['name', 'email', 'password']));

        auth()->login($user);

        return redirect()->to('/');
    }

    public function logout()
    {
        auth()->logout();
        Session::flush();
        Session::put('success', 'You are logout sucessfully');
        return redirect(route('login'));
    }
}
