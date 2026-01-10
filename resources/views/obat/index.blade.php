@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ openModal: false }">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">📦 Manajemen Stok Obat</h1>
            <p class="text-gray-500 mt-1">Pantau ketersediaan dan kelola data inventaris obat.</p>
        </div>
        <button @click="openModal = true" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-xl font-semibold text-white hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all">
            <i class="bi bi-plus-lg mr-2"></i> Tambah Obat Baru
        </button>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-sm rounded-r-lg flex justify-between items-center">
        <span><i class="bi bi-check-circle-fill mr-2"></i> {{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" class="text-green-900">&times;</button>
    </div>
    @endif

    <div class="bg-white shadow-xl shadow-gray-200/50 rounded-2xl overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Nama Obat</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Jenis</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Keterangan</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($obats as $obat)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="bi bi-capsule"></i>
                                </div>
                                <span class="font-semibold text-gray-800">{{ $obat->nama_obat }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-cyan-50 text-cyan-700 border border-cyan-100">
                                {{ $obat->jenis_obat }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($obat->stok <= 5)
                            <div class="flex items-center text-red-600 font-bold">
                                <span class="animate-pulse mr-2 h-2 w-2 rounded-full bg-red-600"></span>
                                {{ $obat->stok }} <span class="ml-1 text-[10px] uppercase">(Kritis)</span>
                            </div>
                            @else
                            <span class="text-gray-700 font-medium">{{ $obat->stok }} Unit</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ Str::limit($obat->keterangan, 40) ?: '-' }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-3">
                                <a href="{{ route('obat.show', $obat->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('obat.edit', $obat->id) }}" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-all" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" onsubmit="return confirm('Yakin hapus obat ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <i class="bi bi-inbox text-gray-200 text-6xl"></i>
                                <p class="mt-4 text-gray-400">Belum ada data obat tersedia.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="openModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 transition-opacity" @click="openModal = false">
                <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
            </div>

            <div x-show="openModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route('obat.store') }}" method="POST">
                    @csrf
                    <div class="bg-white px-8 pt-8 pb-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Tambah Obat Baru</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Obat</label>
                                <input type="text" name="nama_obat" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all bg-gray-50" required placeholder="Contoh: Paracetamol 500mg">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Obat</label>
                                    <select name="jenis_obat" class="w-full px-4 py-2 border border-gray-200 rounded-xl bg-gray-50 outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="Analgesik">Analgesik</option>
                                        <option value="Antibiotik">Antibiotik</option>
                                        <option value="Vitamin">Vitamin</option>
                                        <option value="Sirup">Sirup</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Stok Awal</label>
                                    <input type="number" name="stok" class="w-full px-4 py-2 border border-gray-200 rounded-xl bg-gray-50 outline-none focus:ring-2 focus:ring-blue-500" required min="0">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Keterangan</label>
                                <textarea name="keterangan" rows="3" class="w-full px-4 py-2 border border-gray-200 rounded-xl bg-gray-50 outline-none focus:ring-2 focus:ring-blue-500" placeholder="Catatan tambahan..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-8 py-4 flex justify-end gap-3">
                        <button type="button" @click="openModal = false" class="px-5 py-2 text-sm font-semibold text-gray-600 hover:text-gray-800">Batal</button>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition-all">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection