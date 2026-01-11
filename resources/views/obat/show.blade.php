@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('obat.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center gap-2 font-medium transition-all">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Obat
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-blue-600 px-6 py-4">
                    <h3 class="text-white font-bold flex items-center gap-2">
                        <i class="bi bi-info-circle"></i> Informasi Stok
                    </h3>
                </div>
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-1">{{ $obat->nama_obat }}</h2>
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100 mb-6">
                        {{ $obat->jenis_obat }}
                    </span>

                    <div class="space-y-4">
                        <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                            <p class="text-xs text-gray-400 uppercase font-bold tracking-wider mb-1">Stok Saat Ini</p>
                            <p class="text-3xl font-black {{ $obat->stok <= 5 ? 'text-red-600' : 'text-green-600' }}">
                                {{ $obat->stok }} <span class="text-sm font-medium text-gray-500">Unit</span>
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-400 uppercase font-bold tracking-wider mb-1">Keterangan</p>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                {{ $obat->keterangan ?? 'Tidak ada catatan tambahan untuk obat ini.' }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('obat.edit', $obat->id) }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl transition-all shadow-md shadow-amber-100">
                            <i class="bi bi-pencil-square mr-2"></i> Edit Data Obat
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-50 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">Riwayat Penggunaan Obat</h3>
                    <span class="text-xs text-gray-400 bg-gray-50 px-2 py-1 rounded">{{ $riwayat->count() }} Record</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-gray-50">Tanggal</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-gray-50">Nama Pasien</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-gray-50">Diagnosa Terkait</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($riwayat as $rm)
                            <tr class="hover:bg-blue-50/30 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-600 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($rm->tanggal_periksa)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-800">{{ $rm->pasien->nama_pasien ?? 'Pasien Tidak Ditemukan' }}</div>
                                    <div class="text-[10px] text-gray-400">ID RM: #{{ $rm->id }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ Str::limit($rm->diagnosa, 60) }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="bi bi-folder2-open text-gray-200 text-5xl mb-3"></i>
                                        <p class="text-gray-400">Belum ada pasien yang menggunakan obat ini.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection