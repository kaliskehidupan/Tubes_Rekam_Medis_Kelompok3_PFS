@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('users.index') }}" class="flex items-center gap-2 text-slate-400 hover:text-[#2563eb] transition mb-6 font-semibold text-sm">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali ke Manajemen User</span>
    </a>

    <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-10 py-8 border-b border-gray-50 bg-slate-50/50">
            <h1 class="text-2xl font-bold text-slate-800">Tambah User Baru</h1>
            <p class="text-slate-400 text-sm mt-1">Lengkapi data akun petugas atau admin baru.</p>
        </div>

        <form action="{{ route('users.store') }}" method="POST" class="p-10 space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso"
                    class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-[#2563eb] transition text-sm outline-none">
                @error('name') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Email (Username)</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="user@app.com"
                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-[#2563eb] transition text-sm outline-none">
                    @error('email') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Role Akses</label>
                    <select name="role" class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-[#2563eb] transition text-sm outline-none appearance-none">
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (Petugas)</option>
                        <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                    <input type="password" name="password" placeholder="Minimal 8 karakter"
                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-[#2563eb] transition text-sm outline-none">
                    @error('password') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password"
                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-[#2563eb] transition text-sm outline-none">
                </div>
            </div>

            <div class="pt-6 flex justify-end">
                <button type="submit" class="bg-[#2563eb] hover:bg-blue-700 text-white px-10 py-4 rounded-2xl shadow-lg shadow-blue-200 transition font-bold text-sm">
                    Simpan User Baru
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
