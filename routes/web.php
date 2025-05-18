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



Route::resource('user', UserController::class);
Route::resource('kategori', KategoriController::class);
Route::resource('arsip', ArsipController::class);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Setelah login
Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    return match ($role) {
        'admin' => view('admin.index'),
        'sekretaris' => view('sekretaris.index'),
        'kepala' => view('kepala.index'),
        default => abort(403),
    };
})->middleware('auth')->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
// Arsip - Khusus Admin
Route::get('/admin/arsip', [ArsipController::class, 'index'])->name('admin.arsip.index');
// Users - Khusus Admin
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
// Tampilkan form tambah pengguna
Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
// Form edit user
Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
// Simpan data pengguna
Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');
// Proses update user
Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/admin/arsip/{id}/download', [ArsipController::class, 'download'])->name('admin.arsip.download');
});

