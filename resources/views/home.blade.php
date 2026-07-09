@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- ========================================== -->
<!-- HERO SECTION (Tampilan Atas - Gambar Utama) -->
<!-- ========================================== -->
@php
    // Memastikan $setting tidak null dan hero_images benar-benar sebuah array/berisi data
    $sliderImages = (isset($setting) && is_array($setting->hero_images) && count($setting->hero_images) > 0)
                    ? $setting->hero_images 
                    : ['images/bg-parengan.jpg', 'images/bg-parengan2.jpg', 'images/bg-parengan3.jpg'];
    
    $totalSlides = count($sliderImages);
@endphp

<div class="w-full min-h-[calc(100vh-80px)] relative flex flex-col justify-between overflow-hidden" 
     x-data="{ activeSlide: 0, totalSlides: {{ $totalSlides }} }"
     x-init="if(totalSlides > 1) { setInterval(() => { activeSlide = (activeSlide + 1) % totalSlides }, 5000) }">
    
    <div class="absolute inset-0 z-0">
        @foreach($sliderImages as $index => $image)
            @php
                if (\Illuminate\Support\Str::startsWith($image, 'http')) {
                    // 1. JIKA DARI CLOUDINARY (RAILWAY)
                    $imageSrc = $image;
                } elseif (\Illuminate\Support\Str::startsWith($image, 'beranda/slider')) {
                    // 2. JIKA DARI STORAGE LOKAL (KOMPUTER LOKAL)
                    $imageSrc = asset('storage/' . $image);
                } else {
                    // 3. JIKA GAMBAR FALLBACK / DEFAULT ASSET LOKAL (Cth: 'images/bg-parengan.jpg')
                    $imageSrc = asset($image);
                }
            @endphp
            
            <div x-show="activeSlide === {{ $index }}"
                x-transition:enter="transition opacity duration-1000 ease-out"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition opacity duration-1000 ease-in"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0 bg-cover bg-center" 
                style="background-image: url('{{ $imageSrc }}');"
                @if($index > 0) x-cloak @endif>
            </div>
        @endforeach

        <div class="absolute inset-0 bg-black/30 z-10"></div>
    </div>

    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 flex-grow">
        
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
                <a href="{{ route('desa.profile') }}" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white border border-white/40 backdrop-blur-xs px-5 py-2.5 rounded-lg text-sm font-semibold transition">
                    ℹ️ Profile Desa
                </a>
                <a href="{{ route('desa.pelayanan') }}" class="inline-flex items-center gap-2 bg-slate-900/80 hover:bg-slate-950 text-white border border-slate-700/50 backdrop-blur-xs px-5 py-2.5 rounded-lg text-sm font-semibold transition shadow-md">
                    📋 Layanan Desa
                </a>
            </div>
        </div>

        <div class="lg:col-span-5 bg-black/40 backdrop-blur-md border-l border-white/10 flex flex-col justify-center px-6 sm:px-12 lg:px-16 py-12 text-white" data-aos="fade-left">
            <div class="mb-8">
                <h2 class="text-2xl font-extrabold tracking-wider uppercase relative inline-block">
                    Fitur Unggulan
                    <span class="absolute -bottom-2 left-0 w-16 h-1 bg-amber-500 rounded"></span>
                </h2>
            </div>

            <div class="space-y-4 w-full">
                <a href="{{ route('desa.pelayanan') }}" class="group flex items-center gap-4 bg-white/10 hover:bg-white/15 border border-white/10 p-4 rounded-xl backdrop-blur-xs transition transform hover:-translate-y-0.5">
                    <div class="w-12 h-12 bg-white-900/80 text-white rounded-lg flex items-center justify-center text-xl shadow-inner group-hover:scale-105 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path fill="#FFFFFF" d="M7 2H3a1 1 0 0 0-1 1v18a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1M5 21a2 2 0 1 1 2-2a2 2 0 0 1-2 2m2-9H3V3h4Z" />
                            <circle cx="5.01" cy="19.01" r="1" fill="currentColor" />
                            <path fill="#FFFFFF" d="M14 2h8v2.02h-8zm-4 0h2.01v2.02H10zm4 4h8v2.02h-8zm-4 0h2.01v2.02H10zm4 4h8v2.02h-8zm-4 0h2.01v2.02H10z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-base leading-tight">Layanan Desa</h3>
                        <p class="text-xs text-gray-300 mt-0.5">Layanan Administrasi Terpadu</p>
                    </div>
                </a>

                <a href="{{ route('desa.potensi') }}" class="group flex items-center gap-4 bg-white/10 hover:bg-white/15 border border-white/10 p-4 rounded-xl backdrop-blur-xs transition transform hover:-translate-y-0.5">
                    <div class="w-12 h-12 bg-white-900/80 text-white rounded-lg flex items-center justify-center text-xl shadow-inner group-hover:scale-105 transition">
                        <svg xmlns="http://www.w3.org/2000/xl" width="100%" height="100%" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path fill="#FFFFFF" d="M12 18H6v-4h6m9 0v-2l-1-5H4l-1 5v2h1v6h10v-6h4v6h2v-6m0-10H4v2h16z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-base leading-tight">UMKM Desa</h3>
                        <p class="text-xs text-gray-300 mt-0.5">Produk Lokal Berkualitas</p>
                    </div>
                </a>

                <a href="{{ route('desa.berita') }}" class="group flex items-center gap-4 bg-white/10 hover:bg-white/15 border border-white/10 p-4 rounded-xl backdrop-blur-xs transition transform hover:-translate-y-0.5">
                    <div class="w-12 h-12 bg-white-900/80 text-white rounded-lg flex items-center justify-center text-xl shadow-inner group-hover:scale-105 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path fill="currentColor" d="M5.616 20q-.691 0-1.153-.462T4 18.384V5.616q0-.691.463-1.153T5.616 4h9.29q.323 0 .628.13q.305.132.522.349l3.465 3.465q.218.218.348.522q.131.305.131.628v9.29q0 .691-.462 1.154T18.384 20zM15 5v3.192q0 .348.23.578t.578.23H19zm1 11q.214 0 .357-.143t.143-.357t-.143-.357T16 15H8q-.213 0-.357.143T7.5 15.5t.143.357T8 16zm-4.5-7q.214 0 .357-.143T12 8.5t-.143-.357T11.5 8H8q-.213 0-.357.143T7.5 8.5t.143.357T8 9zm4.5 3.5q.214 0 .357-.143T16.5 12t-.143-.357T16 11.5H8q-.213 0-.357.143T7.5 12t.143.357T8 12.5z" />
                        </svg>
                    </div>
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
            • Info Statistik Desa Real-time
        </span>
    </div>
</div>

<!-- ========================================== -->
<!-- MAIN WRAPPER SECTION (Bg: Slate-50)       -->
<!-- ========================================== -->
<!-- Menginisialisasi Alpine.js dengan state 'activeTab' default 'sambutan' -->
<div class="bg-slate-50 w-full py-16 px-4 sm:px-6 lg:px-8" x-data="{ activeTab: 'sambutan' }">
    <div class="max-w-7xl mx-auto">
        
        <!-- GRID KARTU STATISTIK DESA (Efek Muncul Bergantian ke Atas) -->
        <div x-data="{ activeTab: 'sambutan' }">
            <div class="flex justify-center gap-2 mb-10" data-aos="fade-up">
                <button @click="activeTab = 'sambutan'" 
                        :class="activeTab === 'sambutan' ? 'bg-[#1A365D] text-white' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50'"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold shadow-sm transition">
                    👤 Sambutan
                </button>
                <button @click="activeTab = 'program'" 
                        :class="activeTab === 'program' ? 'bg-[#1A365D] text-white' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50'"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold shadow-sm transition">
                    📋 Program Desa
                </button>
            </div>

            <div x-show="activeTab === 'sambutan'" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                class="bg-white rounded-2xl shadow-xs border border-slate-100 p-8 md:p-12 grid grid-cols-1 lg:grid-cols-12 gap-8 items-start mb-24">
                
                <div class="lg:col-span-3 flex flex-col items-center text-center">
                    <div class="relative w-40 h-40 mb-4">
                        <img src="{{ $setting->kades_foto ? asset('storage/' . $setting->kades_foto) : asset('images/kepala-desa.jpg') }}" 
                            alt="Kepala Desa" 
                            class="w-full h-full object-cover rounded-full shadow-inner border-2 border-slate-100">
                        <span class="absolute bottom-1 right-2 bg-blue-600 text-white rounded-full p-1 text-xs shadow-md border-2 border-white">
                            ✓
                        </span>
                    </div>
                    <h4 class="text-base font-bold text-slate-900 leading-tight">{{ $setting->kades_nama ?? 'Nama Kepala Desa' }}</h4>
                    <p class="text-xs font-semibold text-slate-500 mt-1">Kepala Desa</p>
                    <p class="text-[11px] font-medium text-slate-400 tracking-wider mt-0.5">{{ $setting->kades_masa_jabatan ?? '2025 - 2030' }}</p>
                    <div class="text-amber-400 text-xs mt-2">★★★★★</div>
                </div>

                <div class="lg:col-span-9 text-slate-700 text-sm leading-relaxed space-y-4 font-normal text-justify">
                    @if($setting->sambutan)
                        {!! nl2br(e($setting->sambutan)) !!}
                    @else
                        <p class="font-semibold text-slate-900">Assalamu’alaikum Warahmatullahi Wabarakatuh,</p>
                        <p>Puji syukur kehadirat Allah SWT, Tuhan Yang Maha Kuasa, atas limpahan rahmat, berkah, dan hidayah-Nya, sehingga platform digital resmi Pemerintah Desa Parengan ini dapat hadir ke tengah-tengah kita semua.</p>
                        <p>Atas nama Pemerintah Desa Parengan, Kecamatan Maduran, Kabupaten Lamongan, saya selaku Kepala Desa mengucapkan selamat datang di pusat keterbukaan informasi publik desa kami.</p>
                        <div class="pt-2">
                            <p class="font-bold text-emerald-700 italic">Maju UMKM-nya, Lestari Budayanya, Sejahtera Warganya!</p>
                            <p class="font-semibold text-slate-900 mt-1">Wassalamu’alaikum Warahmatullahi Wabarakatuh.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div x-show="activeTab === 'program'" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                class="bg-white rounded-2xl shadow-xs border border-slate-100 p-8 md:p-12 mb-24" x-cloak>
                
                <div class="max-w-3xl mx-auto text-center mb-8">
                    <h3 class="text-2xl font-bold text-slate-900">Program Kerja & Pemberdayaan Desa</h3>
                    <p class="text-sm text-slate-500 mt-2">Strategi akselerasi pembangunan infrastruktur, ekonomi kreatif, dan pelestarian budaya Desa Parengan.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-5 border border-slate-100 rounded-xl bg-slate-50/50">
                        <div class="text-2xl mb-2">🎨</div>
                        <h4 class="font-bold text-slate-900 text-base">{{ $setting->program_1_judul ?? 'Pengembangan Desa Wisata' }}</h4>
                        <p class="text-xs text-slate-600 mt-1 leading-relaxed">{{ $setting->program_1_deskripsi ?? 'Deskripsi program kerja pertama desa.' }}</p>
                    </div>
                    
                    <div class="p-5 border border-slate-100 rounded-xl bg-slate-50/50">
                        <div class="text-2xl mb-2">🧵</div>
                        <h4 class="font-bold text-slate-900 text-base">{{ $setting->program_2_judul ?? 'Digitalisasi Pasar' }}</h4>
                        <p class="text-xs text-slate-600 mt-1 leading-relaxed">{{ $setting->program_2_deskripsi ?? 'Deskripsi program kerja kedua desa.' }}</p>
                    </div>
                    
                    <div class="p-5 border border-slate-100 rounded-xl bg-slate-50/50">
                        <div class="text-2xl mb-2">⚡</div>
                        <h4 class="font-bold text-slate-900 text-base">{{ $setting->program_3_judul ?? 'Smart Governance' }}</h4>
                        <p class="text-xs text-slate-600 mt-1 leading-relaxed">{{ $setting->program_3_deskripsi ?? 'Deskripsi program kerja ketiga desa.' }}</p>
                    </div>
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
                    <div class="w-10 h-10 bg-white-900 text-white rounded-xl flex items-center justify-center text-lg flex-shrink-0 shadow-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path fill="#FF0000" d="M12 11.5A2.5 2.5 0 0 1 9.5 9A2.5 2.5 0 0 1 12 6.5A2.5 2.5 0 0 1 14.5 9a2.5 2.5 0 0 1-2.5 2.5M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7" />
                        </svg>
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
                
                <a href="https://wa.me/{{ str_replace(['-', ' '], '', $setting->kontak_telepon ?? '085257552704') }}" target="_blank"
                class="bg-white rounded-2xl p-6 flex items-start gap-5 border border-slate-100 shadow-[0_4px_20px_-2px_rgba(0,0,0,0.05)] transition hover:transform hover:-translate-y-0.5 duration-200 flex-grow group">
                    <div class="w-14 h-14 bg-green-600 text-white rounded-2xl flex items-center justify-center text-2xl flex-shrink-0 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70%" height="80%" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path fill="#FFFFFF" d="M6.62 10.79c1.44 2.83 3.76 5.15 6.59 6.59l2.2-2.2c.28-.28.67-.36 1.02-.25c1.12.37 2.32.57 3.57.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.57c.11.35.03.74-.25 1.02z" />
                        </svg>
                    </div>
                    <div class="space-y-1">
                        <h4 class="font-bold text-base text-slate-900 group-hover:text-green-600 transition">Telepon / WhatsApp</h4>
                        <p class="text-sm font-semibold text-slate-800 tracking-wide">{{ $setting->kontak_telepon ?? '0852-57552704' }}</p>
                        <p class="text-xs text-slate-500 font-medium leading-relaxed pt-1">
                            Hubungi kami untuk informasi lebih lanjut tentang desa dan pelayanan yang tersedia
                        </p>
                    </div>
                </a>

                <a href="mailto:{{ $setting->kontak_email ?? 'parengan@gmail.com' }}"
                class="bg-white rounded-2xl p-6 flex items-start gap-5 border border-slate-100 shadow-[0_4px_20px_-2px_rgba(0,0,0,0.05)] transition hover:transform hover:-translate-y-0.5 duration-200 flex-grow group">
                    
                    <div class="w-14 h-14 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center text-2xl flex-shrink-0 shadow-xs group-hover:bg-red-500 group-hover:text-white transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </div>
                    
                    <div class="space-y-1">
                        <h4 class="font-bold text-base text-slate-900 group-hover:text-red-600 transition-colors">Email Resmi</h4>
                        <p class="text-sm font-semibold text-slate-800 tracking-wide">{{ $setting->kontak_email ?? 'parengan@gmail.com' }}</p>
                        <p class="text-xs text-slate-500 font-medium leading-relaxed pt-1">
                            Kirim Email untuk pertanyaan, saran, atau keperluan administrasi Desa
                        </p>
                    </div>
                </a>

                <a href="https://instagram.com/{{ ltrim($setting->kontak_instagram ?? 'parengancolorfull', '@') }}" target="_blank"
                class="bg-white rounded-2xl p-6 flex items-start gap-5 border border-slate-100 shadow-[0_4px_20px_-2px_rgba(0,0,0,0.05)] transition hover:transform hover:-translate-y-0.5 duration-200 flex-grow group">
                    <div class="w-14 h-14 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 256 256">
                            <path d="M0 0h256v256H0z" fill="none" />
                            <g fill="none">
                                <rect width="256" height="256" fill="url(#SVGKdMMobCR)" rx="60" />
                                <rect width="256" height="256" fill="url(#SVGqYUiQbXV)" rx="60" />
                                <path fill="#fff" d="M128.009 28c-27.158 0-30.567.119-41.233.604c-10.646.488-17.913 2.173-24.271 4.646c-6.578 2.554-12.157 5.971-17.715 11.531c-5.563 5.559-8.98 11.138-11.542 17.713c-2.48 6.36-4.167 13.63-4.646 24.271c-.477 10.667-.602 14.077-.602 41.236s.12 30.557.604 41.223c.49 10.646 2.175 17.913 4.646 24.271c2.556 6.578 5.973 12.157 11.533 17.715c5.557 5.563 11.136 8.988 17.709 11.542c6.363 2.473 13.631 4.158 24.275 4.646c10.667.485 14.073.604 41.23.604c27.161 0 30.559-.119 41.225-.604c10.646-.488 17.921-2.173 24.284-4.646c6.575-2.554 12.146-5.979 17.702-11.542c5.563-5.558 8.979-11.137 11.542-17.712c2.458-6.361 4.146-13.63 4.646-24.272c.479-10.666.604-14.066.604-41.225s-.125-30.567-.604-41.234c-.5-10.646-2.188-17.912-4.646-24.27c-2.563-6.578-5.979-12.157-11.542-17.716c-5.562-5.562-11.125-8.979-17.708-11.53c-6.375-2.474-13.646-4.16-24.292-4.647c-10.667-.485-14.063-.604-41.23-.604zm-8.971 18.021c2.663-.004 5.634 0 8.971 0c26.701 0 29.865.096 40.409.575c9.75.446 15.042 2.075 18.567 3.444c4.667 1.812 7.994 3.979 11.492 7.48c3.5 3.5 5.666 6.833 7.483 11.5c1.369 3.52 3 8.812 3.444 18.562c.479 10.542.583 13.708.583 40.396s-.104 29.855-.583 40.396c-.446 9.75-2.075 15.042-3.444 18.563c-1.812 4.667-3.983 7.99-7.483 11.488c-3.5 3.5-6.823 5.666-11.492 7.479c-3.521 1.375-8.817 3-18.567 3.446c-10.542.479-13.708.583-40.409.583c-26.702 0-29.867-.104-40.408-.583c-9.75-.45-15.042-2.079-18.57-3.448c-4.666-1.813-8-3.979-11.5-7.479s-5.666-6.825-7.483-11.494c-1.369-3.521-3-8.813-3.444-18.563c-.479-10.542-.575-13.708-.575-40.413s.096-29.854.575-40.396c.446-9.75 2.075-15.042 3.444-18.567c1.813-4.667 3.983-8 7.484-11.5s6.833-5.667 11.5-7.483c3.525-1.375 8.819-3 18.569-3.448c9.225-.417 12.8-.542 31.437-.563zm62.351 16.604c-6.625 0-12 5.37-12 11.996c0 6.625 5.375 12 12 12s12-5.375 12-12s-5.375-12-12-12zm-53.38 14.021c-28.36 0-51.354 22.994-51.354 51.355s22.994 51.344 51.354 51.344c28.361 0 51.347-22.983 51.347-51.344c0-28.36-22.988-51.355-51.349-51.355zm0 18.021c18.409 0 33.334 14.923 33.334 33.334c0 18.409-14.925 33.334-33.334 33.334s-33.333-14.925-33.333-33.334c0-18.411 14.923-33.334 33.333-33.334" />
                            </g>
                            <defs>
                                <radialGradient id="SVGKdMMobCR" cx="0" cy="0" r="1" gradientTransform="matrix(0 -253.715 235.975 0 68 275.717)" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#fd5" />
                                    <stop offset=".1" stop-color="#fd5" />
                                    <stop offset=".5" stop-color="#ff543e" />
                                    <stop offset="1" stop-color="#c837ab" />
                                </radialGradient>
                                <radialGradient id="SVGqYUiQbXV" cx="0" cy="0" r="1" gradientTransform="rotate(78.68 -32.69 -16.937)scale(113.412 467.488)" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#3771c8" />
                                    <stop offset=".128" stop-color="#3771c8" />
                                    <stop offset="1" stop-color="#60f" stop-opacity="0" />
                                </radialGradient>
                            </defs>
                        </svg>
                    </div>
                    
                    <div class="space-y-1">
                        <h4 class="font-bold text-base text-slate-900 group-hover:text-pink-600 transition">Instagram</h4>
                        <p class="text-sm font-semibold text-slate-800 tracking-wide">
                            {{ str_starts_with($setting->kontak_instagram ?? '@parengancolorfull', '@') ? $setting->kontak_instagram : '@' . $setting->kontak_instagram }}
                        </p>
                        <p class="text-xs text-slate-500 font-medium leading-relaxed pt-1">
                            Kunjungi Instagram untuk melihat informasi terkini di desa
                        </p>
                    </div>
                </a>

            </div>
        </div>

    </div>
</div>
@endsection