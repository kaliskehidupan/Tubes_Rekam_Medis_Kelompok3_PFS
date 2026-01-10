<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Medis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Menggunakan font yang lebih bersih sesuai gambar */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
    </style>
</head>

<body class="text-slate-700">
    <div class="flex min-h-screen">
        <aside class="w-72 bg-white border-r border-gray-200 flex flex-col fixed h-full shadow-sm z-10">
            <div class="p-8">
                <span class="text-2xl font-bold text-[#2563eb]">Rekam Medis</span>
            </div>

            <div class="px-6 mb-8">
                <div class="bg-[#2563eb] rounded-2xl p-6 text-center text-white shadow-lg shadow-blue-200">
                    <div
                        class="bg-white/20 w-16 h-16 rounded-full mx-auto flex items-center justify-center text-2xl font-bold mb-3 border border-white/30">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <h4 class="font-bold text-lg truncate">{{ Auth::user()->name }}</h4>
                    <p class="text-[10px] opacity-80 uppercase tracking-widest mt-1">Role: {{ Auth::user()->role }}</p>
                </div>
            </div>

            <nav class="flex-1 px-4 space-y-1">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-6 py-3.5 rounded-xl transition {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-[#2563eb] font-semibold' : 'text-slate-500 hover:bg-blue-50' }}">
                    <i class="fas fa-columns text-lg"></i>
                    <span>Dashboard</span>
                </a>

                @if (Auth::user()->role == 'superadmin')
                    <div class="mt-6 mb-2 px-6 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        Administrator</div>
                    <a href="{{ route('users.index') }}"
                        class="flex items-center gap-3 px-6 py-3.5 rounded-xl transition {{ request()->routeIs('users.*') ? 'bg-[#2563eb] text-white shadow-md font-semibold' : 'text-slate-500 hover:bg-gray-50' }}">
                        <i class="fas fa-users-cog text-lg"></i>
                        <span>User Management</span>
                    </a>
                @endif
            </nav>

            <div class="p-6 border-t border-gray-100">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-6 py-3 rounded-xl text-rose-500 hover:bg-rose-50 transition font-semibold text-sm">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 ml-72 p-12">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-xl font-semibold text-slate-800 tracking-tight">
                    {{ request()->routeIs('dashboard') ? 'Dashboard' : 'Manajemen User' }}
                </h2>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-medium text-slate-500">
                        {{ Auth::user()->name }} ({{ Auth::user()->role }})
                    </span>
                </div>
            </div>

            @yield('content')
        </main>
    </div>
</body>

</html>
