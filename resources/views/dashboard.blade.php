@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
                <p class="mb-4">Welcome, {{ Auth::user()->name }}!</p>
                <p class="mb-4">Your role is: <span
                        class="font-bold uppercase text-blue-600">{{ Auth::user()->role }}</span></p>

                <hr class="my-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if(Auth::user()->role === 'superadmin')
                        <div class="border p-4 rounded bg-red-50">
                            <h3 class="text-lg font-bold text-red-800">Superadmin Area</h3>
                            <p class="text-sm text-gray-600 mb-2">Manage Users</p>
                            <ul class="list-disc pl-5">
                                <li><a href="{{ route('superadmin.users') }}" class="text-blue-600 hover:underline">Manage Users</a></li>
                            </ul>
                        </div>
                    @endif

                    @if(Auth::user()->role === 'user')
                        <div class="border p-4 rounded bg-green-50">
                            <h3 class="text-lg font-bold text-green-800">User Area</h3>
                            <p class="text-sm text-gray-600 mb-2">Manage Medical Records</p>
                            <ul class="list-disc pl-5 space-y-1">
                                <li><a href="{{ route('user.patients') }}" class="text-blue-600 hover:underline">Patients</a></li>
                                <li><a href="{{ route('user.doctors') }}" class="text-blue-600 hover:underline">Doctors</a></li>
                                
                                {{-- Link ke fitur Obat --}}
                                <li>
                                    <a href="{{ route('obat.index') }}" class="text-blue-600 font-semibold hover:underline">
                                        💊 Medicines & Stock Management
                                    </a>
                                </li>

                                <li><a href="{{ route('user.records') }}" class="text-blue-600 hover:underline">Medical Records</a></li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection