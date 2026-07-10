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
            
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </aside>

    <main class="flex-1 min-h-screen flex flex-col pl-64">
        
        <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-8 sticky top-0 z-30 shadow-sm">
            <div>
                <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Halaman Administrator</h2>
            </div>
            
            <div class="relative inline-block text-left">
                <button id="notification-btn" class="relative p-2 text-slate-500 hover:text-[#1A365D] hover:bg-slate-100 rounded-xl transition-all focus:outline-none cursor-pointer flex items-center justify-center">
                    <i class="fa-solid fa-bell text-xl"></i>
                    
                    @php 
                        $totalNotif = ($unreadSuratCount ?? 0) + ($newBeritaCount ?? 0); 
                    @endphp
                    @if($totalNotif > 0)
                        <span class="absolute top-1 right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[9px] font-bold text-white ring-2 ring-white animate-pulse">
                            {{ $totalNotif }}
                        </span>
                    @endif
                </button>

                <div id="notification-dropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden z-40 transition-all origin-top-right">
                    <div class="px-4 py-3 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                        <span class="text-xs font-bold text-slate-700">Notifikasi Terbaru</span>
                        <span class="text-[10px] bg-blue-100 text-[#1A365D] px-2 py-0.5 rounded-full font-bold">{{ $totalNotif }} Baru</span>
                    </div>
                    
                    <div class="max-h-80 overflow-y-auto divide-y divide-slate-50">
                        
                        @if(isset($latestSuratNotif) && $latestSuratNotif->count() > 0)
                            @foreach($latestSuratNotif as $surat)
                                @php
                                    // Ambil data_input hasil dekripsi dari model
                                    $dataInput = $surat->data_input;
                                    
                                    // Antisipasi jika data_input dikembalikan dalam bentuk string JSON mentah
                                    if (is_string($dataInput)) {
                                        $dataInput = json_decode($dataInput, true);
                                    }
                                    
                                    // Antisipasi jika EncryptedJson mengembalikan Object (stdClass) atau Array
                                    if (is_object($dataInput)) {
                                        $namaPemohon = $dataInput->nama_pemohon ?? 'Warga';
                                    } else {
                                        $namaPemohon = $dataInput['nama_pemohon'] ?? 'Warga';
                                    }
                                @endphp
                                <a href="{{ route('admin.pelayanan.index') }}" class="flex gap-3 p-4 hover:bg-slate-50 transition-all block">
                                    <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 border border-amber-100">
                                        <i class="fa-solid fa-file-invoice text-sm"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-semibold text-slate-800">Permohonan Surat Baru</p>
                                        <p class="text-[11px] text-slate-500 truncate">
                                            <span class="font-medium text-slate-700">{{ $namaPemohon }}</span> mengajukan layanan surat.
                                        </p>
                                        <span class="text-[9px] text-slate-400 block mt-1 font-medium">
                                            <i class="fa-regular fa-clock mr-1"></i>{{ $surat->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        @endif

                        @if(isset($latestBeritaNotif) && $latestBeritaNotif->count() > 0)
                            @foreach($latestBeritaNotif as $berita)
                                <a href="{{ route('admin.berita.index') }}" class="flex gap-3 p-4 hover:bg-slate-50 transition-all block">
                                    <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 border border-blue-100">
                                        <i class="fa-solid fa-newspaper text-sm"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-semibold text-slate-800">Berita Baru Dirilis</p>
                                        <p class="text-[11px] text-slate-500 truncate">{{ $berita->judul }}</p>
                                        <span class="text-[9px] text-slate-400 block mt-1 font-medium">
                                            <i class="fa-regular fa-clock mr-1"></i>{{ $berita->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        @endif

                        @if($totalNotif == 0)
                            <div class="p-8 text-center text-slate-400 text-xs">
                                <i class="fa-solid fa-bell-slash text-2xl mb-2 text-slate-300 block"></i>
                                Belum ada notifikasi baru saat ini.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </header>
        <div class="p-8 flex-1">
            @yield('content')
        </div>

        <footer class="bg-white border-t border-slate-200 h-12 flex items-center justify-center text-xs text-slate-400 font-medium mt-auto">
            &copy; {{ date('Y') }} Pemerintah Desa Parengan. All Rights Reserved.
        </footer>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('notification-btn');
            const dropdown = document.getElementById('notification-dropdown');

            if (btn && dropdown) {
                // Ketika tombol diclick, buka/tutup dropdown
                btn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    dropdown.classList.toggle('hidden');
                });

                // Ketika mengklik area di luar dropdown, otomatis menutup panel dropdown
                document.addEventListener('click', function (e) {
                    if (!dropdown.contains(e.target) && !btn.contains(e.target)) {
                        dropdown.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>
</html>