@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg overflow-hidden mt-8">
    <div class="px-6 py-4 bg-yellow-500">
        <h2 class="text-xl font-bold text-white">Edit User: {{ $user->name }}</h2>
    </div>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        {{-- Input Nama --}}
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                class="w-full px-3 py-2 border rounded-lg @error('name') border-red-500 @enderror">
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Input Email --}}
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                class="w-full px-3 py-2 border rounded-lg @error('email') border-red-500 @enderror">
            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Input Role --}}
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
            <select name="role" class="w-full px-3 py-2 border rounded-lg">
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User (Medis)</option>
                <option value="superadmin" {{ old('role', $user->role) == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
            </select>
            @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Input Password --}}
        <div class="bg-gray-50 p-4 rounded-lg mb-4 border border-gray-200">
            <p class="text-xs text-gray-500 mb-2 italic">*Kosongkan password jika tidak ingin mengganti</p>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Password Baru</label>
                    <input type="password" name="password"
                        class="w-full px-3 py-2 border rounded-lg @error('password') border-red-500 @enderror">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full px-3 py-2 border rounded-lg">
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end mt-6">
            <a href="{{ route('users.index') }}" class="text-gray-600 mr-4 hover:underline">Batal</a>
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-150">
                Update Data User
            </button>
        </div>
    </form>
</div>
@endsection
