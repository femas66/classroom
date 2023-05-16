<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }
    public function login(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|min:3|email',
            'password' => 'required|min:3',
        ]);
        if (Auth::attempt($validatedData)) {
            return redirect()->route('login')->with('success','Berhasil login');
        }
        else {
            return back()->with('error','Gagal login');
            
        }
    }
    public function logout(Request $request) {
        // dd($request->all());
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Berhasil logout');
    }
}
