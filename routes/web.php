<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KomentarMateriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest.check')->group(function () {

    //login
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    
    //register
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});
Route::middleware('auth.check')->group(function () {
    // logout 
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // home page
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // kelas
    Route::prefix('/kelas')->group(function () {
        Route::get('/create', [KelasController::class, 'create'])->name('kelas.create');
        Route::post('/', [KelasController::class, 'store'])->name('kelas.store');
        Route::get('/gabung', [KelasController::class, 'gabungView'])->name('kelas.gabung.index');
        Route::get('/gabung/kode/{kode_kelas}', [KelasController::class, 'gabungUrl'])->name('kelas.gabung.url');
        Route::post('/gabung', [KelasController::class, 'gabungStore'])->name('kelas.gabung.store');
        Route::get('/{id}', [KelasController::class, 'show'])->name('kelas.show');
        Route::get('/edit/{id}', [KelasController::class, 'edit'])->name('kelas.edit');
        Route::put('/edit', [KelasController::class, 'update'])->name('kelas.update');

        Route::get('/anggota/{id}', [KelasController::class, 'listAnggota'])->name('kelas.list.anggota');
        Route::prefix('/materi')->group(function () {
            Route::get('/{id}/create/{user_id}', [MateriController::class, 'create'])->name('materi.create');
            Route::post('/store', [MateriController::class, 'store'])->name('materi.store');
            Route::get('/detail/{id}/kelas/{kelas_id}', [MateriController::class, 'show'])->name('materi.show');
            Route::delete('/{id}', [MateriController::class, 'delete'])->name('materi.delete');
            Route::post('/komentar', [MateriController::class, 'komentarPost'])->name('komentar.post');
        });
        Route::get('/hapus/komentar/{id}', [KomentarMateriController::class, 'delete'])->name('komentar.materi.hapus');
        Route::get('/kick/{user_id}', [KelasController::class, 'kick'])->name('user.kick');
        Route::post('/guru', [KelasController::class, 'guru'])->name('user.guru');
        Route::post('/member', [KelasController::class, 'member'])->name('user.member');
    });
});










