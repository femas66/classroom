<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Materi;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KelasController extends Controller
{
    function create() {
        return view('kelas.buatkelas');
    }
    function listAnggota($id) {
        $lists = UserRole::where('kelas_id', $id)->get();
        $role = UserRole::where('kelas_id', $id)->where('user_id', Auth::user()->id)->first()->role;
        return view('kelas.listanggota', compact('lists', 'role'));
    }
    function store(Request $request) {
        $validatedData = $request->validate([
            'nama_kelas' => 'required|min:2',
            'mata_pelajaran' => 'required|min:2',
        ]);
        $validatedData['kode_kelas'] = Str::random(8);

        $model = Kelas::create($validatedData);
        $id = $model->id;

        UserRole::create(['kelas_id' => $id, 'user_id' => Auth::user()->id, 'role' => 'guru']);
        return redirect()->route('kelas.show', ['id' => $id])->with('success', 'Berhasil membuat kelas');
    }
    function gabungView() {
        return view('kelas.gabungkelas');
    }
    function gabungStore(Request $request) {
        $request->validate([
            'kode_kelas' => 'required|min:5'
        ]);
        $cari = Kelas::where('kode_kelas', $request->kode_kelas);
        if ($cari->count() == 0) {
            return back()->with('error', 'Kelas tidak ditemukan');
        } else {
            $kelas_id = $cari->first()->id;
            $gabung = UserRole::where('user_id', Auth::user()->id)->where('kelas_id', $kelas_id)->count();
            // dd($gabung);
            if ($gabung > 0) {
                return redirect()->route('home')->with('error', 'Anda sudah bergabung');
            }
            else {
                UserRole::create(['kelas_id' => $kelas_id, 'user_id' => Auth::user()->id, 'role' => 'member']);
                return redirect()->route('home')->with('success', 'Berhasil bergabung ke kelas');
            }
        }
    }
    function show($id) {
        $info_kelas = Kelas::find($id);
        $role = UserRole::where('kelas_id', $id)->where('user_id', Auth::user()->id)->first();
        if ($role == null) {
            return redirect()->route('home');
        }
        $materis = Materi::where('kelas_id', $id)->get();
        // dd($kelas);
        return view('kelas.index', compact('info_kelas', 'role', 'materis'));
    }
    function edit($id) {
        $role = UserRole::where('kelas_id', $id)->where('user_id', Auth::user()->id)->first();
        if ($role == null) {
            return redirect()->route('home');
        }
        if ($role->role == 'guru') {
            $kelas = Kelas::find($id);
            return view('kelas.edit', compact('kelas'));
        } else {
            return redirect()->route('home');
        }
    }
    function update(Request $request) {
        // dd($request->all());
        $request->validate([
            'id' => 'required',
            'nama_kelas' => 'required',
            'mata_pelajaran' => 'required'
        ]);
        Kelas::find($request->id)->update(['nama_kelas' => $request->nama_kelas, 'mata_pelajaran' => $request->mata_pelajaran]);
        return redirect()->route('kelas.show', ['id' => $request->id]);
    }

    function kick($user_id) {
        UserRole::where('user_id', $user_id)->delete();
        return back()->with('success', 'Berhasil mengeluarkan user');
    }
}
