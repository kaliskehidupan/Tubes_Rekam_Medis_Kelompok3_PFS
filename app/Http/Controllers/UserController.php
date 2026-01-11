<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller {

    /**
     * Menampilkan daftar semua user (Halaman Utama Superadmin)
     */
    public function index() {
        $users = User::latest()->get();
        return view('users.index', compact('users'));
    }

    /**
     * Membuka form tambah user baru
     */
    public function create() {
        return view('users.create');
    }

    /**
     * Menyimpan user baru ke database (Validasi Form User)
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:superadmin,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Membuka form edit user
     */
    public function edit(User $user) {
        return view('users.edit', compact('user'));
    }

    /**
     * Memperbarui data user (Update User)
     */
    public function update(Request $request, User $user) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id) // Email tetap unik tapi boleh pakai email lama sendiri
            ],
            'role' => 'required|in:superadmin,user',
            'password' => 'nullable|min:8|confirmed', // Password tidak wajib diisi saat edit
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Jika password diisi, maka ganti password lama
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User diperbarui.');
    }

    /**
     * Menghapus user (Fitur Hapus User)
     */
    public function destroy(User $user) {
        // Proteksi: Superadmin tidak boleh menghapus dirinya sendiri
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}
