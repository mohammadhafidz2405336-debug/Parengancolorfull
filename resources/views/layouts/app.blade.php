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

                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/LOGO WEBE.png') }}" alt="Logo Parengan" class="h-6 w-auto object-contain filter drop-shadow-md">
                    
                    <span>Dikembangkan oleh Tim BBM Universitas Negeri Malang Desa Parengan 2026</span>
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
    <div x-data="{ 
                open: false, 
                messages: [], 
                newMessage: '', 
                loading: false,
                async sendChat() {
                    if (!this.newMessage.trim() || this.loading) return;
                    
                    this.messages.push({ sender: 'user', text: this.newMessage });
                    const textToSend = this.newMessage;
                    this.newMessage = '';
                    this.loading = true;

                    // Otomatis scroll ke bawah setelah user kirim pesan
                    this.$nextTick(() => { this.scrollToBottom(); });

                    try {
                        const response = await fetch('{{ route('chat.ai.send') }}', {
                            method: 'POST', 
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ message: textToSend })
                        });

                        const data = await response.json();
                        if (data.success) {
                            this.messages.push({ sender: 'ai', text: data.reply });
                        } else {
                            this.messages.push({ sender: 'ai', text: data.reply || 'Aduh, sistem database desa kami sedang sibuk.' });
                        }
                    } catch (error) {
                        this.messages.push({ sender: 'ai', text: 'Gagal terhubung ke server. Pastikan koneksi internet Anda aktif.' });
                    } finally {
                        this.loading = false;
                        this.$nextTick(() => { this.scrollToBottom(); });
                    }
                },
                scrollToBottom() {
                    if(this.$refs.chatArea) {
                        this.$refs.chatArea.scrollTo({
                            top: this.$refs.chatArea.scrollHeight,
                            behavior: 'smooth'
                        });
                    }
                }
            }" 
            class="fixed bottom-6 right-6 z-50 font-sans">
            
            <button @click="open = !open; if(open) $nextTick(() => scrollToBottom())" 
                    class="bg-gradient-to-r from-[#1A365D] to-[#2a5282] hover:from-[#2a5282] hover:to-[#1A365D] text-white p-3.5 rounded-full shadow-[0_8px_30px_rgb(0,0,0,0.3)] flex items-center justify-center transition-all duration-300 transform hover:scale-110 active:scale-95 border border-slate-600/50 group">
                <div x-show="!open" class="flex items-center justify-center relative">
                    <img src="{{ asset('images/logo-desa.png') }}" onerror="this.src='https://placehold.co/40x40?text=Logo'" alt="Logo Desa" class="w-8 w-8 rounded-full object-cover border border-amber-400/60 shadow-sm transition-transform duration-500 group-hover:rotate-12">
                    <span class="absolute -top-1.5 -right-1.5 flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                    </span>
                </div>
                
                <div x-show="open" x-cloak class="flex items-center justify-center w-8 h-8 transition-transform duration-300 transform rotate-90">
                    <iconify-icon icon="layout-line" width="24" class="text-amber-400" style="transform: rotate(45deg);"></iconify-icon>
                    <iconify-icon icon="mdi:close" width="26" class="text-amber-400"></iconify-icon>
                </div>
            </button>

            <div x-show="open" x-cloak
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-12 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-12 scale-95"
                class="absolute bottom-20 right-0 w-[calc(100vw-2rem)] sm:w-[440px] bg-slate-900/95 backdrop-blur-xl border border-slate-700/70 rounded-xl shadow-[0_20px_50px_rgba(0,0,0,0.4)] flex flex-col overflow-hidden h-[420px]">
                
                <div class="bg-gradient-to-r from-[#1A365D] via-[#1e3e6b] to-[#2a5282] p-4 flex items-center justify-between border-b border-slate-700/60 shadow-md">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <img src="{{ asset('images/logo-desa.png') }}" onerror="this.src='https://placehold.co/40x40?text=Logo'" alt="Logo" class="w-10 h-10 rounded-xl object-cover border border-amber-400/40 p-0.5 bg-slate-800">
                            <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-emerald-500 ring-2 ring-slate-900 animate-pulse"></span>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold text-sm tracking-wide">My Parengan AI</h4>
                            <span class="text-slate-300 text-xs font-light">Asisten Digital Resmi Desa</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-1 bg-emerald-500/10 border border-emerald-500/20 px-2 py-0.5 rounded-full">
                        <span class="text-emerald-400 text-[10px] font-medium uppercase tracking-wider">Aktif</span>
                    </div>
                </div>

                <div x-ref="chatArea" class="flex-grow p-4 overflow-y-auto space-y-4 bg-gradient-to-b from-slate-900 via-slate-900 to-slate-950 scrollbar-thin scrollbar-thumb-slate-800">
                    
                    <div class="flex gap-2.5 items-start max-w-[85%] animate-fade-in">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-[10px]">🤖</div>
                        <div class="bg-slate-800/90 border border-slate-700/40 p-3.5 rounded-xl rounded-tl-none text-slate-200 leading-relaxed shadow-sm">
                            Selamat datang di layanan mandiri! Ada yang bisa saya bantu terkait profil wilayah, info pelayanan surat, berita, atau potensi UMKM di **Desa Parengan**?
                        </div>
                    </div>

                    <template x-for="msg in messages">
                        <div :class="msg.sender === 'user' ? 'justify-end' : 'justify-start'" class="flex w-full items-start gap-2.5">
                            <template x-if="msg.sender !== 'user'">
                                <div class="flex-shrink-0 w-6 h-6 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-[10px]">🤖</div>
                            </template>
                            
                            <div :class="msg.sender === 'user' ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white rounded-br-none font-medium' : 'bg-slate-800/90 border border-slate-700/40 text-slate-200 rounded-tl-none'" 
                                class="p-3.5 rounded-xl max-w-[82%] whitespace-pre-line shadow-md transition-all duration-200 hover:shadow-lg leading-relaxed text-[13.5px]"
                                x-text="msg.text">
                            </div>
                        </div>
                    </template>

                    <div x-show="loading" x-cloak class="flex justify-start w-full items-start gap-2.5">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-[10px]">🤖</div>
                        <div class="bg-slate-800/80 border border-slate-700/30 p-3.5 rounded-xl rounded-tl-none flex items-center gap-1.5 shadow-sm">
                            <span class="w-2 h-2 bg-amber-400 rounded-full animate-bounce" style="animation-delay: 0ms"></span>
                            <span class="w-2 h-2 bg-amber-400 rounded-full animate-bounce" style="animation-delay: 150ms"></span>
                            <span class="w-2 h-2 bg-amber-400 rounded-full animate-bounce" style="animation-delay: 300ms"></span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-slate-950 border-t border-slate-800/80 flex gap-2 items-center">
                    <div class="relative flex-grow">
                        <input type="text" 
                            x-model="newMessage" 
                            @keydown.enter="sendChat" 
                            placeholder="Ketik pertanyaan Anda di sini..." 
                            class="w-full bg-slate-900 border border-slate-700/80 rounded-xl pl-4 pr-10 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500/50 transition-all shadow-inner">
                    </div>
                    <button @click="sendChat" 
                            :disabled="!newMessage.trim() || loading"
                            :class="newMessage.trim() && !loading ? 'bg-amber-500 hover:bg-amber-600 text-slate-950 scale-100' : 'bg-slate-800 text-slate-500 scale-95 cursor-not-allowed'"
                            class="p-2.5 rounded-xl flex items-center justify-center transition-all duration-300 shadow-md">
                        <iconify-icon icon="mdi:send" width="20"></iconify-icon>
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>