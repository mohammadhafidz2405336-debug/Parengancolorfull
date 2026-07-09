<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Parengan Colorfull</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#F0F4F8] text-slate-800 antialiased min-h-screen flex">
    <aside class="w-64 bg-[#1A365D] text-white flex flex-col fixed h-full z-20 shadow-xl">
        <div class="p-6 border-b border-blue-900/50 flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center overflow-hidden p-0.5">
                <img src="{{ asset('images/logo-desa.png') }}" alt="Logo Desa Parengan" class="w-full h-full object-contain">
            </div>
            <div>
                <h1 class="text-sm font-bold tracking-wide">Desa Parengan</h1>
                <p class="text-[10px] text-blue-300 font-medium tracking-wider uppercase">Panel Admin</p>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-blue-800 text-white shadow-inner' : 'text-blue-100 hover:bg-[#1e406d]' }}">
                <i class="fa-solid fa-chart-line w-5"></i> Dashboard
            </a>

            <a href="{{ route('admin.home_setting.edit') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.home_setting.*') ? 'bg-blue-800 text-white shadow-inner' : 'text-blue-100 hover:bg-[#1e406d]' }}">
                <i class="fa-solid fa-sliders w-5"></i> Pengaturan Beranda
            </a>
            
            <a href="{{ route('admin.warga.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.warga.*') ? 'bg-blue-800 text-white shadow-inner' : 'text-blue-100 hover:bg-[#1e406d]' }}">
                <i class="fa-solid fa-users-rectangle w-5"></i> Data Warga
            </a>

            <a href="{{ route('admin.berita.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.berita.*') ? 'bg-blue-800 text-white shadow-inner' : 'text-blue-100 hover:bg-[#1e406d]' }}">
                <i class="fa-solid fa-newspaper w-5"></i> Kelola Berita
            </a>

            <a href="{{ route('admin.profile_desa.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.kependudukan.*') ? 'bg-blue-800 text-white shadow-inner' : 'text-blue-100 hover:bg-[#1e406d]' }}">
                <i class="fa-solid fa-users w-5"></i> Profile Desa
            </a>

            <a href="{{ route('admin.aparatur.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.aparatur.*') ? 'bg-blue-800 text-white shadow-inner' : 'text-blue-100 hover:bg-[#1e406d]' }}">
                <i class="fa-solid fa-user-tie w-5"></i> Aparatur Desa
            </a>

            <!-- TAMBAHAN NAVIGASI BARU -->
            <div class="pt-4 pb-2">
                <p class="px-4 text-[10px] font-bold text-blue-400/50 uppercase tracking-wider">Layanan Warga</p>
            </div>

            <a href="{{ route('admin.pelayanan.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.pelayanan.*') ? 'bg-blue-800 text-white shadow-inner' : 'text-blue-100 hover:bg-[#1e406d]' }}">
                <i class="fa-solid fa-file-invoice w-5"></i> Permohonan Surat
            </a>

            <a href="{{ route('admin.potensi.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.potensi.*') ? 'bg-blue-800 text-white shadow-inner' : 'text-blue-100 hover:bg-[#1e406d]' }}">
                <i class="fa-solid fa-store w-5"></i> Potensi UMKM
            </a>
        </nav>
        <div class="p-4 border-t border-blue-900/50 mt-auto">
            <a href="{{ route('admin.logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-all cursor-pointer">
                <i class="fa-solid fa-right-from-bracket w-5"></i> Logout
            </a>
            
            <!-- Form Tersembunyi untuk Metode POST ke Route Logout -->
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </aside>

    <main class="flex-1 min-h-screen flex flex-col pl-64">
        
        <div class="p-8 flex-1">
            @yield('content')
        </div>

        <footer class="bg-white border-t border-slate-200 h-12 flex items-center justify-center text-xs text-slate-400 font-medium mt-auto">
            &copy; {{ date('Y') }} Pemerintah Desa Parengan. All Rights Reserved.
        </footer>
    </main>

</body>
</html>