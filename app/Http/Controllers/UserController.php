<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //show register/create form
    public function create(){
        return view('users.register');
    }

    //Create New User
    public function store(Request $request){

        $formFields=$request->validate([
            'name' => ['required','min:3'],
            'email' => ['required','email',Rule::unique('users', 'email')],
            'password' => ['required','confirmed','min:6']
        ]);

        $formFields['password']= bcrypt($formFields['password']);

        //create user
        $user = User::create($formFields); 

        //login
        auth()->login($user);

        return redirect('/')->with('message',"user created");
    }

    //logout user
    public function logout(Request $request) {

        auth()->logout();

        //invalidate token
        $request->session()->invalidate();
        //regenerate token
        $request->session()->regenerateToken();

        return redirect('/')->with('message',"user logged out");
    }

    //show login form
    public function login(){

        return view('users.login');
    }

    //authenticate user
    public function authenticate(Request $request){
        $formFields=$request->validate([
            'email' => ['required','email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/')->with('message','You are now logged in');
        }

        return back()->withErrors(['email'=>'Invalid Credentials'])->onlyInput('password');


    }


}
