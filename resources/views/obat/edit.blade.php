@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Edit Data Obat</h2>
        <p class="text-gray-500 text-sm">Perbarui informasi stok atau keterangan obat.</p>
    </div>

    <form action="{{ route('obat.update', $obat->id) }}" method="POST" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        @csrf
        @method('PUT')
        
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Obat</label>
                <input type="text" name="nama_obat" value="{{ old('nama_obat', $obat->nama_obat) }}" 
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all bg-gray-50" required>
                @error('nama_obat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Obat</label>
                    <select name="jenis_obat" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none bg-gray-50">
                        <option value="Analgesik" {{ $obat->jenis_obat == 'Analgesik' ? 'selected' : '' }}>Analgesik</option>
                        <option value="Antibiotik" {{ $obat->jenis_obat == 'Antibiotik' ? 'selected' : '' }}>Antibiotik</option>
                        <option value="Vitamin" {{ $obat->jenis_obat == 'Vitamin' ? 'selected' : '' }}>Vitamin</option>
                        <option value="Sirup" {{ $obat->jenis_obat == 'Sirup' ? 'selected' : '' }}>Sirup</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Stok</label>
                    <input type="number" name="stok" value="{{ old('stok', $obat->stok) }}" 
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none bg-gray-50" required min="0">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
                <textarea name="keterangan" rows="4" 
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none bg-gray-50">{{ old('keterangan', $obat->keterangan) }}</textarea>
            </div>
        </div>

        <div class="mt-8 flex items-center justify-end gap-4">
            <a href="{{ route('obat.index') }}" class="text-gray-500 hover:text-gray-700 font-medium text-sm">Batal</a>
            <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection