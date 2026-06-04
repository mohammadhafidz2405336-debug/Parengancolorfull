@extends('layouts.app') {{-- Sesuaikan dengan nama layout utamamu --}}

@section('title', 'Berita Desa')

@section('content')
<div class="bg-[#F0F4F8] text-slate-800 min-h-screen pb-16">
    
    <div class="relative bg-white py-16 border-b border-slate-200 overflow-hidden shadow-sm">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-50 to-blue-50/50 pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="flex justify-center mb-4" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#1A365D] border border-blue-900/20 text-xs font-semibold tracking-wide text-amber-400 uppercase shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    Informasi Terkini
                </span>
            </div>
            
            <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-3 uppercase" data-aos="fade-up" data-aos-delay="100">
                Berita <span class="text-[#1A365D] italic">Desa</span>
            </h1>
            <p class="text-slate-600 max-w-2xl mx-auto text-sm sm:text-base font-medium leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                Menyajikan informasi terbaru tentang peristiwa, kegiatan terkini, dan artikel jurnalistik dari Desa Parengan.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md hover:border-blue-500/30 transition duration-300 flex flex-col group" data-aos="fade-up">
                <div class="relative aspect-video overflow-hidden bg-slate-100">
                    <img src="{{ asset('images/berita/bg1.jpg') }}" alt="Rembuk Stunting" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider shadow-sm">
                        Kesehatan
                    </span>
                </div>
                
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-3 text-xs text-slate-500 mb-3 font-medium">
                        <span>05 Mei 2026</span>
                        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                        <span>Oleh: Pemdes</span>
                    </div>
                    
                    <h3 class="text-lg font-bold text-slate-900 leading-snug mb-3 group-hover:text-blue-700 transition line-clamp-2">
                        “Rembuk Stunting Desa Parengan 2026: Perkuat Komitmen Bersama Cegah Kasus Sejak Dini”
                    </h3>
                    
                    <p class="text-sm text-slate-600 leading-relaxed mb-5 line-clamp-3">
                        Pemerintah Desa Parengan menggelar kegiatan Rembuk Stunting sebagai agenda rutin tahunan guna menyusun strategi penanganan gizi terpadu di tingkat dusun.
                    </p>
                    
                    <div class="mt-auto">
                        <a href="#" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#1A365D] hover:text-blue-700 transition uppercase tracking-wider group/btn">
                            Baca Selengkapnya 
                            <svg class="w-3.5 h-3.5 transform group-hover/btn:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md hover:border-blue-500/30 transition duration-300 flex flex-col group" data-aos="fade-up" data-aos-delay="100">
                <div class="relative aspect-video overflow-hidden bg-slate-100">
                    <img src="{{ asset('images/berita/bg1.jpg') }}" alt="Penghijauan" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <span class="absolute top-3 left-3 bg-emerald-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider shadow-sm">
                        Lingkungan
                    </span>
                </div>
                
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-3 text-xs text-slate-500 mb-3 font-medium">
                        <span>02 Mei 2026</span>
                        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                        <span>Oleh: Karang Taruna</span>
                    </div>
                    
                    <h3 class="text-lg font-bold text-slate-900 leading-snug mb-3 group-hover:text-blue-700 transition line-clamp-2">
                        “Gerakan Hijau Lestari: Kolaborasi Pemdes dan Warga Tanam Ratusan Bibit Pohon”
                    </h3>
                    
                    <p class="text-sm text-slate-600 leading-relaxed mb-5 line-clamp-3">
                        Guna meningkatkan kualitas udara dan menjaga ekosistem desa, masyarakat Parengan bersama unsur perangkat melakukan penanaman bibit pohon buah dan pelindung.
                    </p>
                    
                    <div class="mt-auto">
                        <a href="#" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#1A365D] hover:text-blue-700 transition uppercase tracking-wider group/btn">
                            Baca Selengkapnya
                            <svg class="w-3.5 h-3.5 transform group-hover/btn:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md hover:border-blue-500/30 transition duration-300 flex flex-col group" data-aos="fade-up" data-aos-delay="200">
                <div class="relative aspect-video overflow-hidden bg-slate-100">
                    <img src="{{ asset('images/berita/bg1.jpg') }}" alt="Pelatihan Jurnalistik" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <span class="absolute top-3 left-3 bg-purple-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider shadow-sm">
                        Edukasi
                    </span>
                </div>
                
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-3 text-xs text-slate-500 mb-3 font-medium">
                        <span>28 April 2026</span>
                        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                        <span>Oleh: Admin</span>
                    </div>
                    
                    <h3 class="text-lg font-bold text-slate-900 leading-snug mb-3 group-hover:text-blue-700 transition line-clamp-2">
                        “Cetak Agen Informasi Andal Lewat Pelatihan Jurnalistik dan Pengelolaan Website”
                    </h3>
                    
                    <p class="text-sm text-slate-600 leading-relaxed mb-5 line-clamp-3">
                        Pemerintah Desa membekali aparatur desa dan jurnalis warga lokal dengan kemampuan menulis berita serta manajemen konten web agar informasi desa lebih transparan.
                    </p>
                    
                    <div class="mt-auto">
                        <a href="#" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#1A365D] hover:text-blue-700 transition uppercase tracking-wider group/btn">
                            Baca Selengkapnya
                            <svg class="w-3.5 h-3.5 transform group-hover/btn:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection