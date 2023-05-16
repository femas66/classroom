<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $kelaslists = UserRole::where('user_id', Auth::user()->id)->get();
        return view('home.index', compact('kelaslists'));
    }
    function create() {
        return view('kelas.buatkelas');
    }
    function store(Request $request) {
        dd($request->all());
    }
}
