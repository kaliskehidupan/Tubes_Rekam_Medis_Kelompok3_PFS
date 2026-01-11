@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
    
    {{-- Header & Tombol Kembali --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Detail Informasi Dokter</h2>
        <a href="{{ route('dokter.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow">
            &larr; Kembali
        </a>
    </div>

    {{-- KARTU 1: INFO PRIBADI DOKTER --}}
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6 border-l-4 border-blue-500">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center md:text-left">
            
            <div class="p-4 bg-gray-50 rounded-lg">
                <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Nama Dokter</p>
                <p class="text-xl font-bold text-gray-800 mt-1">{{ $dokter->nama_dokter }}</p>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg">
                <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Spesialisasi</p>
                <p class="text-xl font-bold text-blue-600 mt-1">{{ $dokter->spesialisasi }}</p>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg">
                <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Nomor Telepon</p>
                <p class="text-xl font-bold text-green-600 mt-1">{{ $dokter->nomor_telepon }}</p>
            </div>

        </div>
    </div>

    {{-- KARTU 2: DAFTAR PASIEN (REKAM MEDIS) --}}
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-bold mb-4 text-gray-800 border-b pb-2 flex items-center">
            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            Riwayat Menangani Pasien
        </h3>

        {{-- Cek apakah ada data rekam medis --}}
        @if($dokter->rekamMedis && $dokter->rekamMedis->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Diagnosa</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($dokter->rekamMedis as $rm)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-700 font-medium">
                                {{ $rm->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{-- TEKNIK ANTI ERROR: Jika kolom 'diagnosa' gak ada, dia cari 'keluhan', dst --}}
                                {{ $rm->diagnosa ?? $rm->keluhan ?? $rm->penyakit ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{-- TEKNIK ANTI ERROR --}}
                                {{ $rm->tindakan ?? $rm->keterangan ?? $rm->solusi ?? '-' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            {{-- Tampilan jika data kosong --}}
            <div class="text-center py-10 bg-gray-50 rounded border-2 border-dashed border-gray-300">
                <p class="text-gray-500 font-medium">Belum ada riwayat rekam medis.</p>
                <p class="text-sm text-gray-400 mt-1">Dokter ini belum menangani pasien, atau data belum diinput.</p>
            </div>
        @endif
    </div>
</div>
@endsection