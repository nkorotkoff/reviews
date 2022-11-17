<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function registration()
    {

        return view('register');
    }

    public function createUser(Request $request)
    {
        $validate =  $request->validate([
            'name' => 'required|string',
            'email' => ['required','email','unique:users,email'],
            'phone' => 'required',
            'password' => ['required',
                'min:6',
                'confirmed'],
            'captcha' => 'required|captcha'
        ]);

            $user = User::create([
                'fio'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'password'=>Hash::make($request->password),
            ]);

        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME)->with('success','Пользователь успешно создан');
    }
    public function reloadCaptcha(){
        return response()->json(['captcha'=> captcha_img()]);
    }
    public function signIn(Request $request){
        $validate = $request->validate([
            'email'=>['required','email'],
            'password'=>'required',
        ]);
        if(Auth::attempt($validate)){
            $request->session()->regenerate();

            return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => 'Неправильный email или пароль',
        ])->onlyInput('email');
    }
    public function login(){
        return view('login');
    }
    public function destroy(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
