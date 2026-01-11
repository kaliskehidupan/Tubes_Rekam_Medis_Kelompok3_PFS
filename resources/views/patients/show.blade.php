@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">
    <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h2 class="text-xl font-bold text-gray-800">Biodata Pasien</h2>
            <a href="{{ route('user.patients') }}" class="text-blue-600 hover:underline text-sm font-medium">← Kembali ke Daftar</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-8 text-sm">
            <p><span class="text-gray-500 font-medium">Nama:</span> {{ $patient->nama_pasien }}</p>
            <p><span class="text-gray-500 font-medium">Gender:</span> {{ $patient->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
            <p><span class="text-gray-500 font-medium">Tgl Lahir:</span> {{ \Carbon\Carbon::parse($patient->tanggal_lahir)->format('d F Y') }}</p>
            <p><span class="text-gray-500 font-medium">Telepon:</span> {{ $patient->nomor_telepon }}</p>
            <p class="md:col-span-2"><span class="text-gray-500 font-medium">Alamat:</span> {{ $patient->alamat }}</p>
        </div>
    </div>

    <div class="bg-white shadow-sm rounded-lg p-6">
        <h3 class="font-bold text-gray-800 mb-4 flex items-center">
            <span class="mr-2">📜</span> Riwayat Pemeriksaan
        </h3>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border">
                <thead class="bg-gray-50 uppercase text-xs font-bold text-gray-600 border-b">
                    <tr>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Dokter</th> <th class="px-4 py-3">Keluhan & Diagnosa</th>
                        <th class="px-4 py-3">Obat yang Diberikan</th> </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($patient->rekamMedis as $rm)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($rm->created_at)->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 font-medium text-blue-700">
                            {{ $rm->dokter->nama_dokter ?? 'Dokter tidak ditemukan' }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="font-bold">K: {{ $rm->keluhan }}</div>
                            <div class="text-gray-500 italic">D: {{ $rm->diagnosa }}</div>
                        </td>
                        <td class="px-4 py-3">
                            @if($rm->obat && $rm->obat->count() > 0)
                                <div class="flex flex-wrap gap-1">
                                    @foreach($rm->obat as $o)
                                        <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded border border-green-200">
                                            {{ $o->nama_obat }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-gray-400">- tidak ada obat -</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-10 text-center text-gray-400 italic bg-gray-50">
                            Belum ada riwayat pemeriksaan medis untuk pasien ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection