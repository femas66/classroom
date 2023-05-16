<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\MateriKomentar;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MateriController extends Controller
{
    function create($id, $user_id) {
        $kelas_id = $id;
        $role = UserRole::where('user_id', $user_id)->where('kelas_id', $id)->first();
        if($role == null) {
            return redirect()->route('home');
        }
        else {
            if ($role->role == 'guru') {
                return view('materi.create', compact('kelas_id'));
            }
            else {
                return redirect()->route('home');
            }
        }
    }
    function delete(Materi $id) {
        $lampiran = $id->lampiran_materi;
        unlink(public_path('lampiran/' . $lampiran));
        $id->delete();
        return back()->with('success', 'Berhasil menghapus materi');
    }
    function store(Request $request) {
        // dd($request->all());
        $request->validate([
            'kelas_id' => 'required',
            'judul_materi' => 'required|min:5',
            'deskripsi_materi' => 'required|min:5',
            'lampiran_materi' => 'required',
        ]);
        $file = $request->file('lampiran_materi');
        $hashedName = $file->hashName();
        $file->move(public_path('lampiran'), $hashedName);
        Materi::create([
            'kelas_id' => $request->kelas_id,
            'judul_materi' => $request->judul_materi,
            'deskripsi_materi' => $request->deskripsi_materi,
            'lampiran_materi' => $hashedName
        ]);
        return redirect()->route('kelas.show', ['id' => $request->kelas_id]);
    }
    function show($id, $kelas_id) {
        $materi = Materi::find($id);
        $kelas_id = UserRole::where('kelas_id', $kelas_id)->where('user_id', Auth::user()->id)->first();
        if ($kelas_id == null) {
            return redirect()->route('home');
        }
        $role = $kelas_id->role;
        $materiKomentar = MateriKomentar::where('materi_id', $id)->get();
        return view('materi.index', compact('materi', 'materiKomentar', 'role'));
    }
    function komentarPost(Request $request) {
        // dd($request->all());
        $validatedData = $request->validate([
            'materi_id' => 'required',
            'user_id' => 'required',
            'komentar' => 'required|min:5',
        ]);
        MateriKomentar::create($validatedData);
        return back()->with('success', 'Berhasil mengirim komentar');
    }
}
