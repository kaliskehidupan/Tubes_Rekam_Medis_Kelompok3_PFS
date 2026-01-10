@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Daftar Pasien</h1>
                <p class="text-sm text-gray-500">Kelola data pasien rumah sakit</p>
            </div>
            <a href="{{ route('patients.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                + Tambah Pasien
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left text-gray-700 uppercase text-xs">
                        <th class="px-4 py-3 border-b">No</th>
                        <th class="px-4 py-3 border-b">Nama Pasien</th>
                        <th class="px-4 py-3 border-b">Jenis Kelamin</th>
                        <th class="px-4 py-3 border-b">Telepon</th>
                        <th class="px-4 py-3 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @forelse ($patients as $index => $p)
                    <tr class="hover:bg-gray-50 border-b">
                        <td class="px-4 py-3">{{ $patients->firstItem() + $index }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $p->nama_pasien }}</td>
                        <td class="px-4 py-3">
                            <span class="{{ $p->jenis_kelamin == 'L' ? 'text-blue-600' : 'text-pink-600' }}">
                                {{ $p->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">{{ $p->nomor_telepon }}</td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('patients.show', $p->id) }}" class="text-blue-500 hover:text-blue-700 underline">Detail</a>
                                <span class="text-gray-300">|</span>
                                <a href="{{ route('patients.edit', $p->id) }}" class="text-yellow-600 hover:text-yellow-800 underline">Edit</a>
                                <span class="text-gray-300">|</span>
                                <form action="{{ route('patients.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus data pasien ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-10 text-center text-gray-400 italic">Belum ada data pasien.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $patients->links() }}
        </div>
    </div>
</div>
@endsection