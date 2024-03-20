<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;


class LoginController extends Controller
{

    public function landingPage() {
    if (Auth::check()) {
        return redirect()->route('dashboard');
        }
        return view('profile');
    }

    public function formLogin() {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    public function login(Request $request){

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            
            return redirect()->route('dashboard');
        }

        return back()->with('danger','Username atau password salah!');
    }

    public function formRegister(){

        return view('register');

    }

    public function register(Request $request){

            $request -> validate([
                'nama_user'     => 'required',
                'username'      => 'required',
                'password'      => 'required',
            ]);
    
            $input = $request->all();
    
            $input['nama_user']         = $request->nama_user;
            $input['username']          = $request->username;
            $input['password']          = Hash::make($request['password']);

            $user                       = User::create($input);
    
            return redirect('login')->with('success','Silahkan lanjutkan login!');

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login')->with('success','Anda berhasil logout!');
    }


}