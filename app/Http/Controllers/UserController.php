<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create() {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,sekretaris,kepala',
            'password' => 'required|string|',
        ]);
    
        try {
            DB::transaction(function () use ($request) {
                $request['password'] = Hash::make($request->password);
                User::create($request->all());
            });
    
            return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan pengguna: ' . $e->getMessage());
        }
    }
    

    public function edit($id) {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|in:admin,sekretaris,kepala',
        'password' => 'nullable|string|min:6',
    ]);

    try {
        DB::transaction(function () use ($request, $user) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();
        });

        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
    }
}


public function destroy($id)
{
    try {
        DB::transaction(function () use ($id) {
            User::destroy($id);
        });

        return back()->with('success', 'Pengguna berhasil dihapus.');
    } catch (\Exception $e) {
        return back()->with('error', 'Gagal menghapus pengguna: ' . $e->getMessage());
    }
}

}
