@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto sm:px-6 lg:px-8 py-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Data Dokter</h2>

        <form action="{{ route('dokter.update', $dokter->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Dokter</label>
                <input type="text" name="nama_dokter" value="{{ $dokter->nama_dokter }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Spesialisasi</label>
                <input type="text" name="spesialisasi" value="{{ $dokter->spesialisasi }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nomor Telepon</label>
                <input type="text" name="nomor_telepon" value="{{ $dokter->nomor_telepon }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('dokter.index') }}" class="text-gray-600 hover:text-gray-800 font-bold py-2 px-4 rounded">
                    Batal
                </a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow focus:outline-none focus:shadow-outline">
                    Update Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection