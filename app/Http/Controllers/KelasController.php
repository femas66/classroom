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
        return view('kelas.listanggota', compact('lists'));
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
        return redirect()->route('home')->with('success', 'Berhasil membuat kelas');
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
}
