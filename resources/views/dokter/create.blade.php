@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto sm:px-6 lg:px-8 py-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Dokter Baru</h2>

        {{-- Pesan Error --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dokter.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Dokter</label>
                <input type="text" name="nama_dokter" value="{{ old('nama_dokter') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="dr. Siapa" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Spesialisasi</label>
                <input type="text" name="spesialisasi" value="{{ old('spesialisasi') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Umum / Gigi / Bedah" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nomor Telepon</label>
                <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="08xxxx" required>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('dokter.index') }}" class="text-gray-600 hover:text-gray-800 font-bold py-2 px-4 rounded">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow focus:outline-none focus:shadow-outline">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection