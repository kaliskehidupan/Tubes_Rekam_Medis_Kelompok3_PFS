@extends('layouts.app')

@section('content')
<div class="mb-10">
    <h1 class="text-3xl font-bold text-slate-800">Dashboard</h1>
    <p class="text-slate-400 mt-2">
        Selamat datang kembali, 
        <span class="text-[#2563eb] font-semibold">{{ Auth::user()->name }}</span>!
    </p>
</div>

<div class="bg-white p-10 rounded-[40px] shadow-sm border border-gray-50 flex items-center justify-between relative overflow-hidden">
    <div class="max-w-md relative z-10">
        <h2 class="text-3xl font-bold text-slate-800 mb-4">Selamat Bekerja!</h2>
        <p class="text-slate-500 text-sm leading-relaxed mb-8">
            Anda login sebagai <span class="font-bold text-[#2563eb]">{{ strtoupper(Auth::user()->role) }}</span>. 
            Gunakan sidebar sebelah kiri untuk menavigasi fitur sistem rekam medis.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- AREA KHUSUS SUPERADMIN --}}
            @if(Auth::user()->role === 'superadmin')
                <div class="border p-4 rounded bg-red-50">
                    <h3 class="text-lg font-bold text-red-800">Superadmin Area</h3>
                    <p class="text-sm text-gray-600 mb-2">Manajemen Akun Petugas</p>
                    <ul class="list-disc pl-5 space-y-1">
                        <li>
                            <a href="{{ route('users.index') }}" class="text-blue-600 hover:underline text-sm">
                                Kelola User →
                            </a>
                        </li>
                    </ul>
                </div>
            @endif

            {{-- AREA KHUSUS USER/PETUGAS --}}
            @if(Auth::user()->role === 'user')
                <div class="border p-4 rounded bg-green-50">
                    <h3 class="text-lg font-bold text-green-800">Petugas Area</h3>
                    <p class="text-sm text-gray-600 mb-2">Layanan Rekam Medis & Obat</p>
                    <ul class="list-disc pl-5 space-y-2">
                        <li><a href="{{ route('pasien.index') }}" class="text-blue-600 hover:underline text-sm font-medium">Data Pasien</a></li>
                        <li><a href="{{ route('dokter.index') }}" class="text-blue-600 hover:underline text-sm font-medium">Data Dokter</a></li>
                        <li>
                            <a href="{{ route('obat.index') }}" class="text-blue-600 hover:underline text-sm font-bold">
                                💊 Manajemen Stok Obat
                            </a>
                        </li>
                        <li><a href="{{ route('rekam-medis.index') }}" class="text-blue-600 hover:underline text-sm font-medium">Rekam Medis</a></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>

    {{-- Ikon Dekorasi --}}
    <div class="w-64 flex justify-end opacity-10">
        <i class="fas fa-stethoscope text-[150px] text-blue-900"></i>
    </div>
</div>
@endsection