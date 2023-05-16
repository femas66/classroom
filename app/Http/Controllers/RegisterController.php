<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }
    public function register(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|min:3|string',
            'email' => 'required|min:3|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        $validatedData['password'] = Hash::make($request->input('password'));
        if (User::create($validatedData)) {
            return redirect()->route('login')->with('success', 'Berhasil registrasi');
        }
        return back()->with('error', 'Gagal registrasi')->withInput();
    }
}
