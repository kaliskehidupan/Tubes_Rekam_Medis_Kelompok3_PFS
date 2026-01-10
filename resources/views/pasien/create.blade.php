@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('users.index') }}" class="flex items-center gap-2 text-slate-400 hover:text-blue-600 transition mb-6 font-semibold text-sm">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali ke Manajemen User</span>
    </a>

    <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-10 py-8 border-b border-gray-50 bg-slate-50/50">
            <h1 class="text-2xl font-bold text-slate-800">Tambah User Baru</h1>
            <p class="text-slate-400 text-sm mt-1">Lengkapi data akun untuk petugas atau admin baru.</p>
        </div>

        <form action="{{ route('users.store') }}" method="POST" class="p-10 space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-blue-600 transition text-sm outline-none">
                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-blue-600 transition text-sm outline-none">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Role</label>
                    <select name="role" class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-blue-600 transition text-sm outline-none">
                        <option value="user">User (Petugas)</option>
                        <option value="superadmin">Superadmin</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                <input type="password" name="password" required
                    class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-blue-600 transition text-sm outline-none">
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl shadow-lg shadow-blue-200 transition font-bold text-sm">
                    Simpan Data User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
