@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-8 border-b border-gray-50 flex justify-between items-center bg-white">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Manajemen User</h1>
            <p class="text-slate-400 text-sm mt-1 font-medium">Kelola hak akses dan data pengguna sistem.</p>
        </div>
        <a href="{{ route('users.create') }}" class="bg-[#2563eb] hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow-sm transition flex items-center gap-2 font-bold text-sm">
            <span class="text-lg">+</span>
            <span>Tambah User</span>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50/50">
                <tr>
                    <th class="px-8 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">No</th>
                    <th class="px-8 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Nama Lengkap</th>
                    <th class="px-8 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">Role</th>
                    <th class="px-8 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Email</th>
                    <th class="px-8 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($users as $index => $user)
                <tr class="hover:bg-slate-50/30 transition">
                    <td class="px-8 py-5 text-sm text-slate-400 font-medium">{{ $index + 1 }}</td>
                    <td class="px-8 py-5 text-sm font-bold text-slate-800">{{ $user->name }}</td>
                    <td class="px-8 py-5 text-sm text-center">
                        <span class="font-semibold {{ $user->role == 'superadmin' ? 'text-rose-500' : 'text-blue-500' }}">
                            {{ strtoupper($user->role) }}
                        </span>
                    </td>
                    <td class="px-8 py-5 text-sm text-slate-500 font-medium">{{ $user->email }}</td>
                    <td class="px-8 py-5">
                        <div class="flex justify-center gap-4 text-xs font-bold uppercase tracking-tighter">
                            <a href="{{ route('users.edit', $user->id) }}" class="text-amber-500 hover:underline">Edit</a>
                            @if(Auth::id() !== $user->id)
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-rose-500 hover:underline" onclick="return confirm('Hapus user ini?')">Hapus</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
