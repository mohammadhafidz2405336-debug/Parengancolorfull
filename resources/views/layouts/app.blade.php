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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-repeat" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    

    <style>
        /* Menerapkan Roboto sebagai font utama */
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 flex flex-col min-h-screen antialiased">

    <!-- ========================================== -->
    <!-- NAVIGATION BAR (Smart Navbar)              -->
    <!-- ========================================== -->
    <nav id="main-navbar" x-data="{ open: false }" class="bg-[#1A365D]/90 border-b border-blue-900/50 sticky top-0 z-50 backdrop-blur-md transform transition-transform duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Logo & Brand Instansi -->
                <div class="flex items-center gap-3">
                    <div class="h-12 w-auto flex-shrink-0 flex items-center">
                        <img src="{{ asset('images/logo-desa.png') }}" alt="Logo Parengan" class="h-full w-auto object-contain filter drop-shadow-md">
                    </div>
                    <div class="flex flex-col justify-center">
                        <span class="block text-sm font-black tracking-wider text-white uppercase leading-none">PARENGAN</span>
                        <span class="block text-sm font-bold text-amber-400 tracking-widest uppercase italic ml-8 leading-none mt-1">COLORFULL</span>
                    </div>
                </div>

                <!-- Desktop Menu Navigasi -->
                <div class="hidden md:flex space-x-2 text-sm font-semibold">
                    <a href="{{ route('desa.home') }}" class="px-4 py-2 rounded-lg transition {{ request()->routeIs('desa.home') ? 'bg-slate-800 text-white shadow-sm' : 'text-slate-300 hover:text-white hover:bg-slate-800/50' }}">Home</a>
                    <a href="{{ route('desa.profile') }}" class="px-4 py-2 rounded-lg transition {{ request()->routeIs('desa.profile') ? 'bg-slate-800 text-white shadow-sm' : 'text-slate-300 hover:text-white hover:bg-slate-800/50' }}">Profile Desa</a>
                    <a href="{{ route('desa.potensi') }}" class="px-4 py-2 rounded-lg transition {{ request()->routeIs('desa.potensi') ? 'bg-slate-800 text-white shadow-sm' : 'text-slate-300 hover:text-white hover:bg-slate-800/50' }}">Potensi</a>
                    <a href="{{ route('desa.pelayanan') }}" class="px-4 py-2 rounded-lg transition {{ request()->routeIs('desa.pelayanan') ? 'bg-slate-800 text-white shadow-sm' : 'text-slate-300 hover:text-white hover:bg-slate-800/50' }}">Pelayanan</a>
                    <a href="{{ route('desa.berita') }}" class="px-4 py-2 rounded-lg transition {{ request()->routeIs('desa.berita') ? 'bg-slate-800 text-white shadow-sm' : 'text-slate-300 hover:text-white hover:bg-slate-800/50' }}">Berita</a>
                </div>

                <!-- Hamburger Button (Mobile) -->
                <div class="flex items-center md:hidden">
                    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-300 hover:text-white hover:bg-slate-800 focus:outline-none transition">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Menu Navigasi -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="md:hidden bg-[#1A365D] border-t border-blue-900/50 px-2 pt-2 pb-4 space-y-1 shadow-inner">
            
            <a href="{{ route('desa.home') }}" class="block px-4 py-2.5 rounded-lg text-base font-medium {{ request()->routeIs('desa.home') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-800/50' }}">Home</a>
            <a href="{{ route('desa.profile') }}" class="block px-4 py-2.5 rounded-lg text-base font-medium {{ request()->routeIs('desa.profile') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-800/50' }}">Profile Desa</a>
            <a href="{{ route('desa.potensi') }}" class="block px-4 py-2.5 rounded-lg text-base font-medium {{ request()->routeIs('desa.potensi') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-800/50' }}">Potensi</a>
            <a href="{{ route('desa.pelayanan') }}" class="block px-4 py-2.5 rounded-lg text-base font-medium {{ request()->routeIs('desa.pelayanan') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-800/50' }}">Pelayanan</a>
            <a href="{{ route('desa.berita') }}" class="block px-4 py-2.5 rounded-lg text-base font-medium {{ request()->routeIs('desa.berita') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-800/50' }}">Berita</a>
        </div>
    </nav>

    <!-- ========================================== -->
    <!-- MAIN CONTENT INJECTION                     -->
    <!-- ========================================== -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- ========================================== -->
    <!-- FOOTER SECTION                             -->
    <!-- ========================================== -->
    <footer class="bg-[#1A365D] text-slate-300 border-t border-blue-900/40 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-12">
                
                <!-- Kolom 1: Profil Singkat -->
                <div class="md:col-span-5 space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo-desa.png') }}" alt="Logo Desa" class="h-10 w-auto filter drop-shadow-md">
                        <div class="flex flex-col">
                            <span class="text-sm font-black text-white tracking-wider uppercase leading-none">PARENGAN</span>
                            <span class="text-xs font-bold text-amber-400 tracking-wider uppercase italic mt-0.5">COLORFULL</span>
                        </div>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed max-w-sm">
                        Website resmi pusat informasi publik dan platform pelayanan digital terpadu Pemerintah Desa Parengan. Berkomitmen mewujudkan tata kelola yang transparan dan inklusif.
                    </p>
                </div>

                <!-- Kolom 2: Tautan Navigasi Cepat -->
                <div class="md:col-span-3 space-y-3">
                    <h4 class="text-xs font-extrabold uppercase tracking-widest text-white border-l-2 border-amber-400 pl-2">
                        Peta Situs
                    </h4>
                    <ul class="space-y-2 text-xs font-medium">
                        <li>
                            <a href="{{ route('desa.home') }}" class="hover:text-amber-400 transition-colors flex items-center gap-1.5">
                                <span>•</span> Home
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('desa.profile') }}" class="hover:text-amber-400 transition-colors flex items-center gap-1.5">
                                <span>•</span> Profil Desa
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('desa.potensi') }}" class="hover:text-amber-400 transition-colors flex items-center gap-1.5">
                                <span>•</span> Potensi Unggulan Desa
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('desa.pelayanan') }}" class="hover:text-amber-400 transition-colors flex items-center gap-1.5">
                                <span>•</span> Pelayanan Digital
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('desa.berita') }}" class="hover:text-amber-400 transition-colors flex items-center gap-1.5">
                                <span>•</span> Berita
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Kolom 3: Kontak & Alamat -->
                <div class="md:col-span-4 space-y-3">
                    <h4 class="text-xs font-extrabold uppercase tracking-widest text-white border-l-2 border-amber-400 pl-2">
                        Hubungi Kami
                    </h4>
                    <ul class="space-y-2.5 text-xs text-slate-400 font-medium">
                        <li class="flex items-start gap-2">
                            <span class="text-sm text-slate-300">📍</span>
                            <span>Kantor Pemerintah Desa Parengan, Kecamatan Maduran, Kabupaten Lamongan, Jawa Timur</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-sm text-slate-300">✉️</span>
                            <a href="mailto:info@desa-parengan.id" class="hover:text-amber-400 transition-colors">info@parengancolorfull.id</a>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Hak Cipta (Bagian Paling Bawah) -->
            <div class="mt-12 pt-6 border-t border-blue-900/30 flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px] text-slate-400 font-medium">
                <p>&copy; {{ date('Y') }} Pemerintah Desa Parengan. All Rights Reserved.</p>
                <div>
                    <img src="{{ asset('images/LOGO WEBE.png') }}" alt="Logo Parengan" class="h-full w-auto object-contain filter drop-shadow-md">
                </div>
                <div class="flex items-center gap-1.5">
                    <span>Dikembangkan oleh Tim BBM (KKN) Universitas Negeri Malang Desa Parengan 2026</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- ========================================== -->
    <!-- EXTERNAL SCRIPTS & ANIMATION INITIALIZATION -->
    <!-- ========================================== -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800, 
            once: true,    
            offset: 100,   
        });

        // ----------------------------------------------------
        // LOGIKA SCRIPT HIDE ON SCROLL (SMART NAVBAR)
        // ----------------------------------------------------
        let lastScrollTop = 0;
        const navbar = document.getElementById('main-navbar');

        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > 80) {
                if (scrollTop > lastScrollTop) {
                    navbar.classList.add('-translate-y-full');
                } else {
                    navbar.classList.remove('-translate-y-full');
                }
            } else {
                navbar.classList.remove('-translate-y-full');
            }
            
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        });
    </script>
</body>
</html>