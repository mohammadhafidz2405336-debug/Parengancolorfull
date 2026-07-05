@extends('layouts.app')

@section('title', 'Potensi Desa')

@section('content')
<div class="w-full min-h-[50vh] bg-cover bg-center relative flex flex-col justify-between" 
     style="background-image: url('{{ asset('images/bg-parengan.jpg') }}');">
    <div class="absolute inset-0 bg-black/50 z-0"></div>

    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 flex-grow">
        <div class="lg:col-span-8 flex flex-col justify-center px-6 sm:px-12 lg:px-20 py-16 text-white" data-aos="fade-right">
            <span class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold uppercase tracking-wider bg-black/20 backdrop-blur-xs px-3 py-1.5 rounded-full w-max mb-3 border border-white/10">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                </span>
                Kekayaan Lokal
            </span>
            <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight leading-tight mb-2 drop-shadow-md">
                Potensi & UMKM Desa
            </h1>
            <p class="text-sm sm:text-lg font-medium text-gray-200 mb-4 drop-shadow-sm max-w-2xl">
                Menjelajahi mahakarya kerajinan tradisional, cita rasa kuliner khas, dan geliat roda ekonomi kreatif masyarakat Desa Parengan.
            </p>
        </div>
    </div>

    <div class="relative z-10 w-full bg-slate-100 py-3 text-center border-t border-gray-200">
        <p class="text-[11px] sm:text-xs text-slate-500 font-medium">
            Sinergi Produk Unggulan • Pemberdayaan Ekonomi Masyarakat • Pelestarian Warisan Budaya
        </p>
    </div>
</div>

<div class="bg-slate-50 w-full py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block text-xs font-bold text-slate-800 bg-slate-200/80 px-4 py-1.5 rounded-full uppercase tracking-wider border border-slate-300/50">
                • Produk Unggulan •
            </span>
            <h2 class="text-3xl font-black text-slate-900 mt-3 tracking-tight">Pesona Potensi Desa Parengan</h2>
            <p class="text-sm font-medium text-slate-500 mt-1 max-w-xl mx-auto">
                Pilar utama ekonomi kreatif desa yang menjadi kebanggaan dan terus didorong perkembangannya hingga kancah nasional.
            </p>
        </div>

       <div class="space-y-16 mb-24">
            @if(!$potensiKiri && !$potensiKanan)
                <div class="text-center text-slate-400 py-10">Belum ada data Potensi Unggulan.</div>
            @else

                @if($potensiKiri)
                    <div class="bg-white rounded-3xl shadow-xs border border-slate-100 p-6 md:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center" data-aos="fade-right">
                        <div class="lg:col-span-5 h-72 sm:h-96 rounded-2xl overflow-hidden shadow-md relative">
                            <img src="{{ $potensiKiri->foto ?? asset('images/placeholder.jpg') }}" 
                            alt="{{ $potensiKiri->nama }}" 
                            class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            <span class="absolute top-4 left-4 bg-blue-800 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                🌟 {{ $potensiKiri->kategori ?? 'Unggulan' }}
                            </span>
                        </div>
                        <div class="lg:col-span-7 space-y-4">
                            <h3 class="text-2xl font-black text-slate-900">{{ $potensiKiri->nama }}</h3>
                            <p class="text-slate-600 text-sm leading-relaxed text-justify">
                                {{ $potensiKiri->deskripsi }}
                            </p>
                            @if($potensiKiri->kontak)
                            <div class="pt-2">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $potensiKiri->kontak) }}" target="_blank" class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-4 py-2 rounded-lg inline-flex items-center gap-2 transition-all hover:bg-emerald-100">
                                    <i class="fa-brands fa-whatsapp text-lg"></i> Hubungi Pemilik
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                @endif

                @if($potensiKanan)
                    <div class="bg-white rounded-3xl shadow-xs border border-slate-100 p-6 md:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center" data-aos="fade-left">
                    <div class="lg:col-span-5 h-72 sm:h-96 rounded-2xl overflow-hidden shadow-md relative">
                            <img src="{{ $potensiKanan->foto ?? asset('images/placeholder.jpg') }}" 
                            alt="{{ $potensiKanan->nama }}" 
                            class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            <span class="absolute top-4 left-4 bg-blue-800 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                🌟 {{ $potensiKanan->kategori ?? 'Unggulan' }}
                            </span>
                    </div>    
                    <div class="lg:col-span-7 space-y-4 order-2 lg:order-1">
                            <h3 class="text-2xl font-black text-slate-900">{{ $potensiKanan->nama }}</h3>
                            <p class="text-slate-600 text-sm leading-relaxed text-justify">
                                {{ $potensiKanan->deskripsi }}
                            </p>
                            @if($potensiKanan->kontak)
                            <div class="pt-2">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $potensiKanan->kontak) }}" target="_blank" class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-4 py-2 rounded-lg inline-flex items-center gap-2 transition-all hover:bg-emerald-100">
                                    <i class="fa-brands fa-whatsapp text-lg"></i> Hubungi Pemilik
                                </a>
                            </div>
                            @endif
                        </div>
                        <div class="lg:col-span-5 h-72 sm:h-96 rounded-2xl overflow-hidden shadow-md relative order-1 lg:order-2">
                            <img src="{{ $potensiKanan->foto ? $potensiKanan->foto : asset('images/placeholder.jpg') }}" 
                                alt="{{ $potensiKanan->nama }}" 
                                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            <span class="absolute top-4 right-4 bg-amber-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                🌟 {{ $potensiKanan->kategori ?? 'Unggulan' }}
                            </span>
                        </div>
                    </div>
                @endif

            @endif
        </div>

        <div class="text-center mb-12" data-aos="fade-up">
            <span class="inline-block text-xs font-bold text-slate-800 bg-slate-200/80 px-4 py-1.5 rounded-full uppercase tracking-wider border border-slate-300/50">
                • Direktori Bisnis •
            </span>
            <h2 class="text-3xl font-black text-slate-900 mt-3 tracking-tight">Daftar UMKM Desa Parengan</h2>
            <p class="text-sm font-medium text-slate-500 mt-1">
                Mendukung usaha lokal masyarakat guna memperkuat kemandirian ekonomi desa.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" data-aos="fade-up">
            
            @forelse($umkmList as $item)
            <div class="bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden flex flex-col justify-between transform hover:-translate-y-2 hover:shadow-md transition-all duration-300">
                <div>
                    <div class="h-48 bg-slate-200 relative">
                        <img src="{{ $item->foto ? $item->foto : asset('images/placeholder.jpg') }}" 
                            alt="{{ $item->nama }}" 
                            class="w-full h-full object-cover">
                        <span class="absolute bottom-3 left-3 bg-blue-900/90 text-white text-[10px] font-bold px-2 py-0.5 rounded-md backdrop-blur-xs">
                            Kategori: {{ $item->kategori ?? 'Lainnya' }}
                        </span>
                    </div>
                    <div class="p-6 space-y-2">
                        <h4 class="font-bold text-lg text-slate-900 leading-tight">{{ $item->nama }}</h4>
                        <p class="text-xs text-slate-500 font-medium flex items-center gap-1">
                            📍 {{ $item->lokasi ?? 'Desa Parengan' }}
                        </p>
                        <p class="text-xs text-slate-600 leading-relaxed pt-2 line-clamp-3">
                            {{ $item->deskripsi }}
                        </p>
                    </div>
                </div>
                
                <div class="p-6 pt-0 border-t border-slate-50 mt-4 flex flex-col gap-3">
                    <div class="flex items-center justify-between text-[11px] font-bold text-slate-400">
                        <span>Pemilik: {{ $item->pemilik ?? '-' }}</span>
                    </div>
                    
                    <div class="flex gap-2">
                        @if($item->koordinat)
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($item->koordinat) }}" target="_blank" class="flex-1 inline-flex items-center justify-center gap-1 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-bold px-3 py-2 rounded-xl transition shadow-2xs">
                            <i class="fa-solid fa-map-location-dot"></i> Lihat Lokasi
                        </a>
                        @endif

                        @if($item->kontak)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->kontak) }}" target="_blank" class="flex-1 inline-flex items-center justify-center gap-1 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-3 py-2 rounded-xl transition shadow-2xs">
                            <i class="fa-brands fa-whatsapp text-sm"></i> Hubungi
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
                <div class="col-span-full text-center text-slate-400 py-10">Belum ada data UMKM yang terdaftar.</div>
            @endforelse

        </div>

    </div>
</div>
@endsection