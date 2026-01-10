@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
    <div class="bg-white shadow-sm rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Tambah Pasien Baru</h2>
        <hr class="mb-6">

        <form action="{{ route('patients.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                    <input type="text" name="nama_pasien" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="number" name="nomor_telepon" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea name="alamat" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('user.patients') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Simpan Pasien</button>
            </div>
        </form>
    </div>
</div>
@endsection