<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
     // Menampilkan halaman form register
     public function showRegistrationForm()
     {
         return view('auth.register');
     }
 
     // Menangani penyimpanan data registrasi
     public function register(Request $request)
     {
         // Validasi input
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users',
             'password' => 'required|string',
             'role' => 'required|in:admin,sekretaris,kepala',
         ]);
 
         // Simpan ke database
         User::create([
             'name'     => $request->name,
             'email'    => $request->email,
             'password' => Hash::make($request->password),
             'role'     => $request->role,
         ]);
 
         // Redirect setelah sukses register
         return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
     }


    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            //Jika berhasil login, ambil data user
            $user = Auth::user();
            $role = $user->role;

            // Arahkan sesuai role
            return match ($role) {
                'admin' => view('admin.index'),
                'sekretaris' => view('sekretaris.index'),
                'kepala' => view('kepala.index'),
                default => abort(403),
            };
        }

       // Jika gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}





