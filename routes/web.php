<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfilController;


// Halaman utama
Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Setelah login
Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    return match ($role) {
        'admin' => view('dashboard'),
        'sekretaris' => view('sekretaris.index'),
        'kepala' => view('kepala.index'),
        default => abort(403),
    };
})->middleware('auth')->name('dashboard');