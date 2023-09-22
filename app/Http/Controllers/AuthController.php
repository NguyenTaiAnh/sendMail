<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class AuthController extends Controller
{
    public function getLogin(){
        if(auth()){
            auth()->logout();
        }
        $user = User::all();
        $countUser = count($user);
        return view('auth.login', compact('countUser'));
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
            if (Auth::user()->is_admin == 1){
                return redirect()->route('dashboard')->with('success','Login Successfull');
            }else{
                return redirect()->route('email.index')->with('success','Login Successfull');
            }
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
        $checkAccount = User::where('email',request()->email)->first();
//        dump($checkAccount);
//        dd(request()->email);
//        $checkAccount = User::where()
        if (!$checkAccount){
            $user = User::create(request(['name', 'email', 'password','is_admin']));
            auth()->login($user);

            return redirect()->to('/');
        }
        else{
            Session::put('error', 'Account already exists');

            return redirect()->to('/register');

        }


    }

    public function logout()
    {
        auth()->logout();
        Session::flush();
        Session::put('success', 'You are logout sucessfully');
        return redirect(route('login'));
    }
}
