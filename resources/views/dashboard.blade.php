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

        <div class="flex gap-4">
            <div class="px-6 py-2.5 bg-blue-50 text-[#2563eb] rounded-full text-[11px] font-bold uppercase tracking-wider border border-blue-100">
                Status: <span class="text-[#2563eb]">Aktif</span>
            </div>
        </div>
    </div>

    <div class="w-64 flex justify-end">
        <i class="fas fa-stethoscope text-[150px] text-blue-900 opacity-[0.03]"></i>
    </div>
</div>
@endsection
