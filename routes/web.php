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
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('regis');

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
Route::get('/admin/arsip/{id}', [ArsipController::class, 'show'])->name('admin.arsip.show');
Route::get('/admin/arsip/{id}/edit', [ArsipController::class, 'edit'])->name('admin.arsip.edit');
Route::put('/admin/arsip/{id}', [ArsipController::class, 'update'])->name('admin.arsip.update');
Route::delete('/admin/arsip/{id}', [ArsipController::class, 'destroy'])->name('admin.arsip.destroy');
Route::get('/admin/arsip/{id}/download', [ArsipController::class, 'download'])->name('admin.arsip.download');
});


Route::middleware(['auth', 'sekretaris'])->group(function () {
// Kategori - Khusus Sekretarris
Route::get('/sekretaris/kategori', [KategoriController::class, 'index'])->name('sekretaris.kategori.index');
// Arsip - Khusus Sekretaris
Route::get('/sekretaris/arsip', [ArsipController::class, 'index'])->name('sekretaris.arsip.index');
Route::get('/sekretaris/arsip/create', [ArsipController::class, 'create'])->name('sekretaris.arsip.create');
Route::post('/sekretaris/arsip/store', [ArsipController::class, 'store'])->name('sekretaris.arsip.store');
Route::get('/sekretaris/arsip/{id}', [ArsipController::class, 'show'])->name('arsip.show');
Route::get('/sekretaris/arsip/{id}/edit', [ArsipController::class, 'edit'])->name('arsip.edit');
Route::put('/sekretaris/arsip/{id}', [ArsipController::class, 'update'])->name('sekretaris.arsip.update');
Route::delete('/sekretaris/arsip/{id}', [ArsipController::class, 'destroy'])->name('arsip.destroy');
// Tampilkan form tambah kategori
Route::get('/sekretaris/kategori/create', [KategoriController::class, 'create'])->name('sekretaris.kategori.create');
// Simpan data kategori
Route::post('/sekretaris/kategori', [KategoriController::class, 'store'])->name('sekretaris.kategori.store');
// Form edit kategori
Route::get('/sekretaris/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('sekretaris.kategori.edit');
// Proses update kategori
Route::put('/sekretaris/kategori/{id}', [KategoriController::class, 'update'])->name('sekretaris.kategori.update');
Route::delete('/sekretaris/kategori/{id}', [KategoriController::class, 'destroy'])->name('sekretaris.kategori.destroy');
Route::get('/sekretaris/arsip/{id}/download', [ArsipController::class, 'download'])->name('sekretaris.arsip.download');
});

// Arsip - Khusus Kepala Desa
Route::middleware(['auth', 'kepala'])->group(function () {
    Route::get('/kepala/arsip', [ArsipController::class, 'index'])->name('kepala.arsip.index');
    Route::get('/kepala/arsip/{id}/download', [ArsipController::class, 'download'])->name('kepala.arsip.download');
});

Route::middleware('auth')->group(function () {
    Route::get('/profil/create', [ProfilController::class, 'create'])->name('profil.create');
    Route::post('/profil/store', [ProfilController::class, 'simpanProfil'])->name('profil.store');
    Route::get('/profil/show', [ProfilController::class, 'show'])->name('profil.show');
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil/update', [ProfilController::class, 'update'])->name('profil.update');
    Route::get('/{role}/arsip/{id}/view', [ArsipController::class, 'view'])->name('arsip.view');
});


