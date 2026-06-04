<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Parengan Colorfull</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Menerapkan Roboto sebagai font utama */
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 flex flex-col min-h-screen antialiased">

    <nav id="main-navbar" class="bg-[#1A365D]/90 border-b border-blue-900/50 sticky top-0 z-50 backdrop-blur-md transform transition-transform duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo-desa.png') }}" alt="Logo Parengan" class="w-auto h-15 object-contain filter drop-shadow-md">
                    <div>
                        <span class="block text-sm font-black tracking-wider text-white uppercase leading-tight">PARENGAN</span>
                        <span class="block text-sm font-bold text-amber-400 tracking-widest uppercase italic -mt-0.5 ml-8">COLORFULL</span>
                    </div>
                </div>

                <div class="hidden md:flex space-x-2 text-sm font-semibold">
                    <a href="{{ route('desa.home') }}" class="px-4 py-2 rounded-lg transition {{ request()->routeIs('desa.home') ? 'bg-slate-800 text-white shadow-sm' : 'text-slate-300 hover:text-white hover:bg-slate-800/50' }}">Home</a>
                    <a href="{{ route('desa.profile') }}" class="px-4 py-2 rounded-lg transition {{ request()->routeIs('desa.profile') ? 'bg-slate-800 text-white shadow-sm' : 'text-slate-300 hover:text-white hover:bg-slate-800/50' }}">Profile Desa</a>
                    <a href="{{ route('desa.potensi') }}" class="px-4 py-2 rounded-lg transition {{ request()->routeIs('desa.potensi') ? 'bg-slate-800 text-white shadow-sm' : 'text-slate-300 hover:text-white hover:bg-slate-800/50' }}">Potensi</a>
                    <a href="{{ route('desa.pelayanan') }}" class="px-4 py-2 rounded-lg transition {{ request()->routeIs('desa.pelayanan') ? 'bg-slate-800 text-white shadow-sm' : 'text-slate-300 hover:text-white hover:bg-slate-800/50' }}">Pelayanan</a>
                    <a href="{{ route('desa.berita') }}" class="px-4 py-2 rounded-lg transition {{ request()->routeIs('desa.berita') ? 'bg-slate-800 text-white shadow-sm' : 'text-slate-300 hover:text-white hover:bg-slate-800/50' }}">Berita</a>
                    <a href="{{ route('desa.contact') }}" class="px-4 py-2 rounded-lg transition {{ request()->routeIs('desa.contact') ? 'bg-slate-800 text-white shadow-sm' : 'text-slate-300 hover:text-white hover:bg-slate-800/50' }}">Contact</a>
                </div>

            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800, 
            once: true,    
            offset: 100,   
        });

        // ----------------------------------------------------
        // LOGIKA SCRIPT LOGIKA HIDE ON SCROLL (SMART NAVBAR)
        // ----------------------------------------------------
        let lastScrollTop = 0;
        const navbar = document.getElementById('main-navbar');

        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            // Batasi agar efek baru berjalan setelah men-scroll melewati tinggi navbar (misal > 80px)
            if (scrollTop > 80) {
                if (scrollTop > lastScrollTop) {
                    // Scroll ke Bawah -> Sembunyikan navbar dengan mendorongnya ke atas luar layar
                    navbar.classList.add('-translate-y-full');
                } else {
                    // Scroll ke Atas -> Munculkan kembali navbar ke posisi normal
                    navbar.classList.remove('-translate-y-full');
                }
            } else {
                // Di paling atas layar -> Pastikan tetap tampil
                navbar.classList.remove('-translate-y-full');
            }
            
            // Perbarui posisi scroll terakhir, pastikan tidak bernilai negatif saat di-bounce (iOS device)
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        });
    </script>
</body>
</html>