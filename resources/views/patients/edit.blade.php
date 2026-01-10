@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
    <div class="bg-white shadow-sm rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Edit Data Pasien</h2>
        <hr class="mb-6">

        <form action="{{ route('patients.update', $patient->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                    <input type="text" name="nama_pasien" value="{{ old('nama_pasien', $patient->nama_pasien) }}" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $patient->tanggal_lahir) }}" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="L" {{ old('jenis_kelamin', $patient->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $patient->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="number" name="nomor_telepon" value="{{ old('nomor_telepon', $patient->nomor_telepon) }}" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea name="alamat" rows="3" 
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('alamat', $patient->alamat) }}</textarea>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3 border-t pt-6">
                <a href="{{ route('user.patients') }}" class="bg-gray-100 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-200 transition">
                    Batal
                </a>
                <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded-md hover:bg-yellow-600 shadow-sm transition">
                    Update Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection