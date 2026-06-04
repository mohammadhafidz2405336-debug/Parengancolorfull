@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- ========================================== -->
<!-- HERO SECTION (Tampilan Atas - Gambar Utama) -->
<!-- ========================================== -->
<div class="w-full min-h-[calc(100vh-80px)] bg-cover bg-center relative flex flex-col justify-between" 
     style="background-image: url('{{ asset('images/bg-parengan.jpg') }}');">
    <div class="absolute inset-0 bg-black/30 z-0"></div>

    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 flex-grow">
        
        <!-- Sisi Kiri Hero: Muncul Geser dari Kiri -->
        <div class="lg:col-span-7 flex flex-col justify-center px-6 sm:px-12 lg:px-20 py-12 text-white" data-aos="fade-right">
            <span class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold uppercase tracking-wider bg-black/20 backdrop-blur-xs px-3 py-1.5 rounded-full w-max mb-3 border border-white/10">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                </span>
                Desa Digital
            </span>
            <h1 class="text-6xl sm:text-8xl font-extrabold tracking-tight leading-tight mb-2 drop-shadow-md">
                Desa Parengan
            </h1>
            <p class="text-sm sm:text-lg font-medium text-gray-200 mb-8 drop-shadow-sm max-w-xl">
                Kecamatan Maduran, Kabupaten Lamongan, Provinsi Jawa Timur
            </p>
            
            <div class="flex flex-wrap gap-4">
                <a href="#" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white border border-white/40 backdrop-blur-xs px-5 py-2.5 rounded-lg text-sm font-semibold transition">
                    ℹ️ Profile Desa
                </a>
                <a href="#" class="inline-flex items-center gap-2 bg-slate-900/80 hover:bg-slate-950 text-white border border-slate-700/50 backdrop-blur-xs px-5 py-2.5 rounded-lg text-sm font-semibold transition shadow-md">
                    📋 Layanan Desa
                </a>
            </div>
        </div>

        <!-- Sisi Kanan Hero (Fitur): Muncul Geser dari Kanan -->
        <div class="lg:col-span-5 bg-black/40 backdrop-blur-md border-l border-white/10 flex flex-col justify-center px-6 sm:px-12 lg:px-16 py-12 text-white" data-aos="fade-left">
            <div class="mb-8">
                <h2 class="text-2xl font-extrabold tracking-wider uppercase relative inline-block">
                    Fitur Unggulan
                    <span class="absolute -bottom-2 left-0 w-16 h-1 bg-amber-500 rounded"></span>
                </h2>
            </div>

            <div class="space-y-4 w-full">
                <a href="#" class="group flex items-center gap-4 bg-white/10 hover:bg-white/15 border border-white/10 p-4 rounded-xl backdrop-blur-xs transition transform hover:-translate-y-0.5">
                    <div class="w-12 h-12 bg-blue-900/80 text-white rounded-lg flex items-center justify-center text-xl shadow-inner group-hover:scale-105 transition">🗂️</div>
                    <div>
                        <h3 class="font-bold text-base leading-tight">Layanan Desa</h3>
                        <p class="text-xs text-gray-300 mt-0.5">Layanan Administration Terpadu</p>
                    </div>
                </a>
                <a href="#" class="group flex items-center gap-4 bg-white/10 hover:bg-white/15 border border-white/10 p-4 rounded-xl backdrop-blur-xs transition transform hover:-translate-y-0.5">
                    <div class="w-12 h-12 bg-blue-900/80 text-white rounded-lg flex items-center justify-center text-xl shadow-inner group-hover:scale-105 transition">🏪</div>
                    <div>
                        <h3 class="font-bold text-base leading-tight">UMKM Desa</h3>
                        <p class="text-xs text-gray-300 mt-0.5">Produk Lokal Berkualitas</p>
                    </div>
                </a>
                <a href="#" class="group flex items-center gap-4 bg-white/10 hover:bg-white/15 border border-white/10 p-4 rounded-xl backdrop-blur-xs transition transform hover:-translate-y-0.5">
                    <div class="w-12 h-12 bg-blue-900/80 text-white rounded-lg flex items-center justify-center text-xl shadow-inner group-hover:scale-105 transition">📰</div>
                    <div>
                        <h3 class="font-bold text-base leading-tight">Berita Desa</h3>
                        <p class="text-xs text-gray-300 mt-0.5">Informasi Terkini</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="relative z-10 w-full bg-slate-100 py-3 text-center border-t border-gray-200">
        <span class="inline-block text-xs font-semibold text-slate-600 bg-slate-200/70 px-3 py-1 rounded-md mb-1">
            • Desa Digital
        </span>
        <p class="text-[11px] sm:text-xs text-slate-500 font-medium">
            Informasi statistik terkini tentang jumlah penduduk, UMKM, layanan, dan berita desa
        </p>
    </div>
</div>

<!-- ========================================== -->
<!-- MAIN WRAPPER SECTION (Bg: Slate-50)       -->
<!-- ========================================== -->
<!-- Menginisialisasi Alpine.js dengan state 'activeTab' default 'sambutan' -->
<div class="bg-slate-50 w-full py-16 px-4 sm:px-6 lg:px-8" x-data="{ activeTab: 'sambutan' }">
    <div class="max-w-7xl mx-auto">
        
        <!-- GRID KARTU STATISTIK DESA (Efek Muncul Bergantian ke Atas) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
    
            <!-- Kartu 1 - Penduduk -->
            <div class="bg-white rounded-2xl shadow-xs border-t-4 border-blue-800 p-6 flex flex-col justify-between relative overflow-hidden h-40 transform hover:-translate-y-2 hover:shadow-md transition-all duration-300 cursor-pointer"
                 data-aos="fade-up" data-aos-delay="0">
                <span class="absolute right-4 top-6 text-6xl opacity-5 select-none">👥</span>
                <div>
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-800 bg-blue-50 px-2.5 py-1 rounded-md">
                        👥 Penduduk
                    </span>
                    <div class="mt-4 flex items-baseline gap-1">
                        <span class="text-4xl font-extrabold text-slate-900 tracking-tight">21</span>
                        <span class="text-xs font-bold text-blue-600">jiwa</span>
                    </div>
                </div>
                <p class="text-xs font-medium text-slate-500 border-t border-slate-100 pt-3">Total Penduduk Desa</p>
            </div>

            <!-- Kartu 2 - UMKM (Delay 100ms) -->
            <div class="bg-white rounded-2xl shadow-xs border-t-4 border-amber-500 p-6 flex flex-col justify-between relative overflow-hidden h-40 transform hover:-translate-y-2 hover:shadow-md transition-all duration-300 cursor-pointer"
                 data-aos="fade-up" data-aos-delay="100">
                <span class="absolute right-4 top-6 text-6xl opacity-5 select-none">🏪</span>
                <div>
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-700 bg-amber-50 px-2.5 py-1 rounded-md">
                        💼 UMKM
                    </span>
                    <div class="mt-4 flex items-baseline gap-1">
                        <span class="text-4xl font-extrabold text-slate-900 tracking-tight">17</span>
                        <span class="text-xs font-bold text-amber-600">unit</span>
                    </div>
                </div>
                <p class="text-xs font-medium text-slate-500 border-t border-slate-100 pt-3">Total UMKM Desa</p>
            </div>

            <!-- Kartu 3 - Berita (Delay 200ms) -->
            <div class="bg-white rounded-2xl shadow-xs border-t-4 border-green-500 p-6 flex flex-col justify-between relative overflow-hidden h-40 transform hover:-translate-y-2 hover:shadow-md transition-all duration-300 cursor-pointer"
                 data-aos="fade-up" data-aos-delay="200">
                <span class="absolute right-4 top-6 text-6xl opacity-5 select-none">📰</span>
                <div>
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-green-700 bg-green-50 px-2.5 py-1 rounded-md">
                        📄 Berita
                    </span>
                    <div class="mt-4 flex items-baseline gap-1">
                        <span class="text-4xl font-extrabold text-slate-900 tracking-tight">10</span>
                        <span class="text-xs font-bold text-green-600">artikel</span>
                    </div>
                </div>
                <p class="text-xs font-medium text-slate-500 border-t border-slate-100 pt-3">Total Artikel Diterbitkan</p>
            </div>

            <!-- Kartu 4 - Layanan (Delay 300ms) -->
            <div class="bg-white rounded-2xl shadow-xs border-t-4 border-purple-500 p-6 flex flex-col justify-between relative overflow-hidden h-40 transform hover:-translate-y-2 hover:shadow-md transition-all duration-300 cursor-pointer"
                 data-aos="fade-up" data-aos-delay="300">
                <span class="absolute right-4 top-6 text-6xl opacity-5 select-none">🗂️</span>
                <div>
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-purple-700 bg-purple-50 px-2.5 py-1 rounded-md">
                        📑 Layanan
                    </span>
                    <div class="mt-4 flex items-baseline gap-1">
                        <span class="text-4xl font-extrabold text-slate-900 tracking-tight">9</span>
                        <span class="text-xs font-bold text-purple-600">Jenis</span>
                    </div>
                </div>
                <p class="text-xs font-medium text-slate-500 border-t border-slate-100 pt-3">Total Layanan Desa</p>
            </div>
        </div>

        <!-- TOMBOL TOGGLE SAMBUTAN & PROGRAM DESA INTERAKTIF -->
        <div class="flex justify-center gap-2 mb-10" data-aos="fade-up">
            <!-- Tombol Sambutan -->
            <button @click="activeTab = 'sambutan'" 
                    :class="activeTab === 'sambutan' ? 'bg-[#1A365D] text-white' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50'"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold shadow-sm transition">
                👤 Sambutan
            </button>
            <!-- Tombol Program Desa -->
            <button @click="activeTab = 'program'" 
                    :class="activeTab === 'program' ? 'bg-[#1A365D] text-white' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50'"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold shadow-sm transition">
                📋 Program Desa
            </button>
        </div>

        <!-- PANEL CONTENT 1: SAMBUTAN KEPALA DESA -->
        <div x-show="activeTab === 'sambutan'" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             class="bg-white rounded-2xl shadow-xs border border-slate-100 p-8 md:p-12 grid grid-cols-1 lg:grid-cols-12 gap-8 items-start mb-24">
            
            <div class="lg:col-span-3 flex flex-col items-center text-center">
                <div class="relative w-40 h-40 mb-4">
                    <img src="{{ asset('images/kepala-desa.jpg') }}" alt="Kepala Desa" class="w-full h-full object-cover rounded-full shadow-inner border-2 border-slate-100">
                    <span class="absolute bottom-1 right-2 bg-blue-600 text-white rounded-full p-1 text-xs shadow-md border-2 border-white">
                        ✓
                    </span>
                </div>
                <h4 class="text-base font-bold text-slate-900 leading-tight">Nama Kepala Desa</h4>
                <p class="text-xs font-semibold text-slate-500 mt-1">Kepala Desa</p>
                <p class="text-[11px] font-medium text-slate-400 tracking-wider mt-0.5">2025 - 2030</p>
                <div class="text-amber-400 text-xs mt-2">★★★★★</div>
            </div>

            <div class="lg:col-span-9 text-slate-700 text-sm leading-relaxed space-y-4 font-normal text-justify">
                <p class="font-semibold text-slate-900">Assalamu’alaikum Warahmatullahi Wabarakatuh,</p>
                <p class="font-semibold text-slate-900 -mt-2">Salam sejahtera untuk kita semua, Om Swastiastu, Namo Buddhaya, Salam Kebajikan.</p>
                
                <p>Puji syukur kehadirat Allah SWT, Tuhan Yang Maha Kuasa, atas limpahan rahmat, berkah, dan hidayah-Nya, sehingga platform digital resmi Pemerintah Desa Parengan ini dapat hadir ke tengah-tengah kita semua.</p>
                <p>Atas nama Pemerintah Desa Parengan, Kecamatan Maduran, Kabupaten Lamongan, saya selaku Kepala Desa beserta seluruh jajaran perangkat desa, mengucapkan selamat datang di gerbang pariwisata digital dan pusat keterbukaan informasi publik desa kami. Website ini bukan sekadar mengikuti tren teknologi, melainkan sebuah wujud nyata dari komitmen, dedikasi, dan transparansi kami dalam menghadirkan tata kelola pemerintahan yang bersih, akuntabel, responsif, dan berbasis teknologi informasi.</p>
                <p>Desa Parengan adalah tanah yang diberkahi dengan perpaduan luar biasa antara kekayaan sejarah, warisan budaya leluhur, dan semangat modernitas. Kami bangga berdiri sebagai sentra industri kerajinan Tenun Ikat legendaris. Sebuah mahakarya kain tradisional yang ditenun dengan ketelitian tinggi oleh tangan-tangan terampil warga kami, yang sejarahnya telah mengakar kuat sejak zaman kolonial dan kini kualitasnya telah diakui hingga menembus pasar internasional, termasuk Timur Tengah. Tenun ini bukan sekadar komoditas ekonomi, melainkan identitas dan harga diri budaya desa kami yang terus kami lestarikan dari generasi ke generasi.</p>
                <p>Tidak berhenti pada warisan tradisi, Desa Parengan kini bertransformasi menjadi ruang kreatif yang dinamis melalui pesona Desa Wisata Mural. Melalui coretan kanvas dinding di sepanjang sudut desa, kami menyatukan semangat gotong royong warga, estetika seni kontemporer, dan narasi sejarah lokal menjadi sebuah daya tarik wisata edukatif yang rekreatif. Festival Mural yang kami selenggarakan adalah bukti nyata bahwa pemuda, seniman, dan seluruh elemen masyarakat Parengan memiliki kreativitas tanpa batas yang mampu menggerakkan roda ekonomi kreatif. Hadirnya website resmi ini mengemban misi besar. Bagi warga masyarakat Desa Parengan, baik yang menetap di desa maupun para perantau yang sedang berjuang di berbagai belahan dunia, platform ini adalah jembatan silaturahmi sekaligus pusat pelayanan publik. Kami berkomitmen untuk terus memangkas birokrasi, mempermudah akses administrasi, serta menyajikan transparansi pengelolaan dana desa secara jujur dan terbuka demi kemaslahatan bersama.</p>
                <p>Sedangkan bagi para wisatawan, investor, mitra bisnis, dan masyarakat luas, website ini adalah jendela utama untuk menjelajahi potensi terbaik kami. Kami membuka pintu kolaborasi selebar-lebarnya untuk kemajuan UMKM, pengembangan pariwisata, dan investasi kebudayaan yang berkelanjutan. Pembangunan desa tidak akan pernah berjalan optimal tanpa adanya sinergi dan partisipasi aktif dari seluruh lapisan masyarakat. Oleh karena itu, mari bersama-sama, bahu-membahu, kita satukan visi dan langkah untuk membangun Desa Parengan yang lebih maju, mandiri, berbudaya, dan sejahtera.</p>
                <p>Terima kasih atas kunjungan, dukungan, dan perhatian Anda di website resmi ini. Semoga langkah digital ini membawa keberkahan dan kemajuan yang nyata bagi kita semua.</p>
                
                <div class="pt-2">
                    <p class="font-bold text-emerald-700 italic">Maju UMKM-nya, Lestari Budayanya, Sejahtera Warganya!</p>
                    <p class="font-semibold text-slate-900 mt-1">Wassalamu’alaikum Warahmatullahi Wabarakatuh.</p>
                </div>
            </div>
        </div>

        <!-- PANEL CONTENT 2: PROGRAM DESA -->
        <div x-show="activeTab === 'program'" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             class="bg-white rounded-2xl shadow-xs border border-slate-100 p-8 md:p-12 mb-24" x-cloak>
            
            <div class="max-w-3xl mx-auto text-center mb-8">
                <h3 class="text-2xl font-bold text-slate-900">Program Kerja & Pemberdayaan Desa</h3>
                <p class="text-sm text-slate-500 mt-2">Strategi akselerasi pembangunan infrastruktur, ekonomi kreatif, dan pelestarian budaya Desa Parengan.</p>
            </div>

            <!-- Konten List/Grid Program (Silakan sesuaikan isinya) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-5 border border-slate-100 rounded-xl bg-slate-50/50">
                    <div class="text-2xl mb-2">🎨</div>
                    <h4 class="font-bold text-slate-900 text-base">Pengembangan Desa Wisata Mural</h4>
                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">Pemberdayaan klaster pemuda dan seniman lokal guna mempercantik tata ruang lingkungan desa sekaligus memicu perputaran ekonomi kreatif.</p>
                </div>
                <div class="p-5 border border-slate-100 rounded-xl bg-slate-50/50">
                    <div class="text-2xl mb-2">🧵</div>
                    <h4 class="font-bold text-slate-900 text-base">Digitalisasi Pasar Tenun Ikat</h4>
                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">Pelatihan e-commerce dan strategi branding global terpadu bagi pengrajin lokal untuk memperluas jangkauan ekspor kerajinan tenun tradisional.</p>
                </div>
                <div class="p-5 border border-slate-100 rounded-xl bg-slate-50/50">
                    <div class="text-2xl mb-2">⚡</div>
                    <h4 class="font-bold text-slate-900 text-base">Parengan Smart Governance</h4>
                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">Optimalisasi sistem manajemen administrasi surat-menyurat satu pintu berbasis aplikasi guna menghadirkan pelayanan publik yang serba praktis.</p>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- SECTION: LOKASI & KONTAK                   -->
        <!-- ========================================== -->
        <!-- Header Section -->
        <div class="text-center mb-10" data-aos="fade-up">
            <span class="inline-block text-xs font-bold text-slate-800 bg-slate-200/80 px-4 py-1.5 rounded-full uppercase tracking-wider border border-slate-300/50">
                • Lokasi & Kontak
            </span>
            <h3 class="text-sm font-semibold text-slate-600 mt-3 tracking-wide">
                Temukan lokasi dan informasi kontak Desa Parengan
            </h3>
        </div>

        <!-- Grid Lokasi & List Kontak -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch" data-aos="fade-up">
            
            <!-- Kiri: Peta Alamat Kantor Desa -->
            <div class="bg-white rounded-2xl shadow-xs border border-slate-100 p-6 flex flex-col h-full">
                <!-- Info Alamat Header -->
                <div class="flex items-start gap-4 mb-4">
                    <div class="w-10 h-10 bg-slate-900 text-white rounded-xl flex items-center justify-center text-lg flex-shrink-0 shadow-xs">
                        📍
                    </div>
                    <div>
                        <h4 class="font-bold text-base text-slate-900 leading-tight">Alamat Kantor Desa</h4>
                        <p class="text-xs text-slate-500 font-medium mt-1 leading-relaxed">
                            Jl. Raya Maduran No.66, Parengan, Kec. Maduran, Kabupaten Lamongan, Jawa Timur 62261
                        </p>
                    </div>
                </div>
                
                <!-- Embed Google Maps -->
                <div class="w-full flex-grow min-h-[350px] rounded-xl overflow-hidden border border-slate-100 shadow-xs relative">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1980.1150093992783!2d112.28529287560401!3d-6.98216079453008!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e77ed0062e6fa77%3A0x7720c5bf6053bd93!2sBalai%20Desa%20Parengan!5e0!3m2!1sid!2sid!4v1780331417525!5m2!1sid!2sid" width="100%" height="100%" style="border:0; position:absolute; top:0; left:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <!-- Kanan: Stack Kartu Kontak -->
            <div class="flex flex-col justify-between gap-6">
                
                <!-- Card 1: Telepon -->
                <div class="bg-white rounded-2xl p-6 flex items-start gap-5 border border-slate-100 shadow-[0_4px_20px_-2px_rgba(0,0,0,0.05)] transition hover:transform hover:-translate-y-0.5 duration-200 flex-grow">
                    <div class="w-14 h-14 bg-blue-600 text-white rounded-2xl flex items-center justify-center text-2xl flex-shrink-0 shadow-md">
                        📞
                    </div>
                    <div class="space-y-1">
                        <h4 class="font-bold text-base text-slate-900">Telepon</h4>
                        <p class="text-sm font-semibold text-slate-800 tracking-wide">0863536829</p>
                        <p class="text-xs text-slate-500 font-medium leading-relaxed pt-1">
                            Hubungi kami untuk informasi lebih lanjut tentang desa dan pelayanan yang tersedia
                        </p>
                    </div>
                </div>

                <!-- Card 2: Email -->
                <div class="bg-white rounded-2xl p-6 flex items-start gap-5 border border-slate-100 shadow-[0_4px_20px_-2px_rgba(0,0,0,0.05)] transition hover:transform hover:-translate-y-0.5 duration-200 flex-grow">
                    <div class="w-14 h-14 bg-purple-600 text-white rounded-2xl flex items-center justify-center text-2xl flex-shrink-0 shadow-md">
                        ✉️
                    </div>
                    <div class="space-y-1">
                        <h4 class="font-bold text-base text-slate-900">Email</h4>
                        <p class="text-sm font-semibold text-slate-800 tracking-wide">parengan@gmail.com</p>
                        <p class="text-xs text-slate-500 font-medium leading-relaxed pt-1">
                            Kirim Email untuk pertanyaan, saran, atau keperluan administrasi Desa
                        </p>
                    </div>
                </div>

                <!-- Card 3: Instagram -->
                <div class="bg-white rounded-2xl p-6 flex items-start gap-5 border border-slate-100 shadow-[0_4px_20px_-2px_rgba(0,0,0,0.05)] transition hover:transform hover:-translate-y-0.5 duration-200 flex-grow">
                    <div class="w-14 h-14 bg-amber-500 text-white rounded-2xl flex items-center justify-center text-2xl flex-shrink-0 shadow-md">
                        📸
                    </div>
                    <div class="space-y-1">
                        <h4 class="font-bold text-base text-slate-900">Instagram</h4>
                        <p class="text-sm font-semibold text-slate-800 tracking-wide">@parengancolorfull</p>
                        <p class="text-xs text-slate-500 font-medium leading-relaxed pt-1">
                            Kunjungi Instagram untuk melihat informasi terkini di desa
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection