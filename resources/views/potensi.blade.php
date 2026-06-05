@extends('layouts.app')

@section('title', 'Potensi Desa')

@section('content')
<!-- ========================================== -->
<!-- HERO SECTION (Tampilan Atas - Gambar Utama) -->
<!-- ========================================== -->
<div class="w-full min-h-[50vh] bg-cover bg-center relative flex flex-col justify-between" 
     style="background-image: url('{{ asset('images/bg-parengan.jpg') }}');">
    <div class="absolute inset-0 bg-black/50 z-0"></div>

    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 flex-grow">
        <!-- Sisi Kiri Hero -->
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

    <!-- Jalur Statistik Ringkas -->
    <div class="relative z-10 w-full bg-slate-100 py-3 text-center border-t border-gray-200">
        <p class="text-[11px] sm:text-xs text-slate-500 font-medium">
            Sinergi Produk Unggulan • Pemberdayaan Ekonomi Masyarakat • Pelestarian Warisan Budaya
        </p>
    </div>
</div>

<!-- ========================================== -->
<!-- MAIN WRAPPER SECTION (Bg: Slate-50)       -->
<!-- ========================================== -->
<div class="bg-slate-50 w-full py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        <!-- ========================================== -->
        <!-- SECTION 1: POTENSI UNGGULAN DESA           -->
        <!-- ========================================== -->
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block text-xs font-bold text-slate-800 bg-slate-200/80 px-4 py-1.5 rounded-full uppercase tracking-wider border border-slate-300/50">
                • Produk Unggulan •
            </span>
            <h2 class="text-3xl font-black text-slate-900 mt-3 tracking-tight">Pesona Potensi Desa Parengan</h2>
            <p class="text-sm font-medium text-slate-500 mt-1 max-w-xl mx-auto">
                Dua pilar utama ekonomi kreatif desa yang menjadi kebanggaan dan terus didorong perkembangannya hingga kancah nasional.
            </p>
        </div>

        <div class="space-y-16 mb-24">
            <!-- Potensi 1: Tenun Ikat (Z-Pattern Kiri) -->
            <div class="bg-white rounded-3xl shadow-xs border border-slate-100 p-6 md:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center" data-aos="fade-right">
                <div class="lg:col-span-5 h-72 sm:h-96 rounded-2xl overflow-hidden shadow-md relative">
                    <img src="{{ asset('images/ikat3.jpg') }}" alt="Tenun Ikat Parengan" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                    <span class="absolute top-4 left-4 bg-blue-800 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                        🧵 Kerajinan Budaya
                    </span>
                </div>
                <div class="lg:col-span-7 space-y-4">
                    <h3 class="text-2xl font-black text-slate-900">Kerajinan Seni Tenun Ikat Legendaris</h3>
                    <p class="text-slate-600 text-sm leading-relaxed text-justify">
                        Desa Parengan berdiri kokoh sebagai sentra industri kerajinan **Tenun Ikat** legendaris. Mahakarya kain tradisional ini ditenun dengan ketelitian tinggi oleh tangan-tangan terampil warga kami, dengan akar sejarah yang kuat sejak zaman kolonial. Kini, kualitas produknya telah diakui hingga menembus pasar internasional, termasuk Timur Tengah. Tenun ini bukan sekadar komoditas ekonomi, melainkan identitas dan harga diri budaya desa.
                    </p>
                    <div class="pt-2 flex flex-wrap gap-2">
                        <span class="text-xs font-semibold text-blue-800 bg-blue-50 px-3 py-1.5 rounded-lg">✓ Kualitas Ekspor</span>
                        <span class="text-xs font-semibold text-blue-800 bg-blue-50 px-3 py-1.5 rounded-lg">✓ Warisan Leluhur</span>
                        <span class="text-xs font-semibold text-blue-800 bg-blue-50 px-3 py-1.5 rounded-lg">✓ Pewarna Berkualitas</span>
                    </div>
                </div>
            </div>

            <!-- Potensi 2: Kue Gapi (Z-Pattern Kanan - Rekomendasi Pak Kades) -->
            <div class="bg-white rounded-3xl shadow-xs border border-slate-100 p-6 md:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center" data-aos="fade-left">
                <div class="lg:col-span-7 space-y-4 order-2 lg:order-1">
                    <div class="flex items-center gap-2">
                        <h3 class="text-2xl font-black text-slate-900">Kue Gapit: Cita Rasa Kuliner Khas yang Renyah</h3>
                        <span class="bg-amber-500 text-white text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded-md animate-pulse">
                            Prioritas Kades
                        </span>
                    </div>
                    <p class="text-slate-600 text-sm leading-relaxed text-justify">
                        Sesuai dengan arahan dan komitmen penuh dari Kepala Desa untuk menaikkan kelas ekonomi mikro, **Kue Gapi** menjadi produk kuliner unggulan yang kini diproyeksikan menjadi ikon buah tangan khas Desa Parengan. Memiliki tekstur yang renyah dengan perpaduan rasa manis dan gurih yang pas, kue tradisional ini diproduksi secara higienis oleh kelompok ibu-ibu kreatif desa dengan resep turun-temurun yang terus dipertahankan keasliannya.
                    </p>
                    <div class="pt-2 flex flex-wrap gap-2">
                        <span class="text-xs font-semibold text-amber-700 bg-amber-50 px-3 py-1.5 rounded-lg">✓ Resep Otentik</span>
                        <span class="text-xs font-semibold text-amber-700 bg-amber-50 px-3 py-1.5 rounded-lg">✓ Tanpa Pengawet</span>
                        <span class="text-xs font-semibold text-amber-700 bg-amber-50 px-3 py-1.5 rounded-lg">✓ Oleh-Oleh Khas</span>
                    </div>
                </div>
                <div class="lg:col-span-5 h-72 sm:h-96 rounded-2xl overflow-hidden shadow-md relative order-1 lg:order-2">
                    <img src="{{ asset('images/gapit.jpg') }}" alt="Kue Gapi Khas Parengan" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                    <span class="absolute top-4 right-4 bg-amber-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                        🍪 Kuliner Khas
                    </span>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- SECTION 2: DAFTAR UMKM DESA                -->
        <!-- ========================================== -->
        <div class="text-center mb-12" data-aos="fade-up">
            <span class="inline-block text-xs font-bold text-slate-800 bg-slate-200/80 px-4 py-1.5 rounded-full uppercase tracking-wider border border-slate-300/50">
                • Direktori Bisnis •
            </span>
            <h2 class="text-3xl font-black text-slate-900 mt-3 tracking-tight">Daftar UMKM Desa Parengan</h2>
            <p class="text-sm font-medium text-slate-500 mt-1">
                Mendukung usaha lokal masyarakat guna memperkuat kemandirian ekonomi desa.
            </p>
        </div>

        <!-- Grid Kartu UMKM -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" data-aos="fade-up">
            
            <!-- UMKM 1: Kelompok Tenun -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden flex flex-col justify-between transform hover:-translate-y-2 hover:shadow-md transition-all duration-300">
                <div>
                    <div class="h-48 bg-slate-200 relative">
                        <img src="{{ asset('images/umkm-tenun-1.jpg') }}" alt="UMKM Tenun" class="w-full h-full object-cover">
                        <span class="absolute bottom-3 left-3 bg-blue-900/90 text-white text-[10px] font-bold px-2 py-0.5 rounded-md backdrop-blur-xs">
                            Kategori: Konveksi/Tekstil
                        </span>
                    </div>
                    <div class="p-6 space-y-2">
                        <h4 class="font-bold text-lg text-slate-900 leading-tight">Tenun Ikat Makmur Jaya</h4>
                        <p class="text-xs text-slate-500 font-medium flex items-center gap-1">
                            📍 Dusun Parengan Barat, RT 02/RW 01
                        </p>
                        <p class="text-xs text-slate-600 leading-relaxed pt-2">
                            Menyediakan berbagai motif kain tenun ikat khas Parengan dengan kualitas bahan katun dan sutra premium. Berdiri sejak tahun 1998.
                        </p>
                    </div>
                </div>
                <div class="p-6 pt-0 border-t border-slate-50 mt-4 flex items-center justify-between">
                    <span class="text-[11px] font-bold text-slate-400">Pemilik: Bpk. Ahmad</span>
                    <a href="https://wa.me/628xxxxxxxxxx" target="_blank" class="inline-flex items-center gap-1 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-3 py-1.5 rounded-lg transition shadow-xs">
                        💬 Hubungi
                    </a>
                </div>
            </div>

            <!-- UMKM 2: Produsen Kue Gapi -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden flex flex-col justify-between transform hover:-translate-y-2 hover:shadow-md transition-all duration-300">
                <div>
                    <div class="h-48 bg-slate-200 relative">
                        <img src="{{ asset('images/umkm-gapi-1.jpg') }}" alt="UMKM Kue Gapi" class="w-full h-full object-cover">
                        <span class="absolute bottom-3 left-3 bg-amber-600/90 text-white text-[10px] font-bold px-2 py-0.5 rounded-md backdrop-blur-xs">
                            Kategori: Makanan Ringan
                        </span>
                    </div>
                    <div class="p-6 space-y-2">
                        <div class="flex items-center justify-between">
                            <h4 class="font-bold text-lg text-slate-900 leading-tight">Kue Gapi "Renyah Barokah"</h4>
                        </div>
                        <p class="text-xs text-slate-500 font-medium flex items-center gap-1">
                            📍 Dusun Parengan Timur, RT 04/RW 02
                        </p>
                        <p class="text-xs text-slate-600 leading-relaxed pt-2">
                            Memproduksi kue gapi renyah skala rumah tangga dengan berbagai varian rasa seperti original wijen, cokelat, dan pandan alami.
                        </p>
                    </div>
                </div>
                <div class="p-6 pt-0 border-t border-slate-50 mt-4 flex items-center justify-between">
                    <span class="text-[11px] font-bold text-slate-400">Pemilik: Ibu Siti Aminah</span>
                    <a href="https://wa.me/628xxxxxxxxxx" target="_blank" class="inline-flex items-center gap-1 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-3 py-1.5 rounded-lg transition shadow-xs">
                        💬 Hubungi
                    </a>
                </div>
            </div>

            <!-- UMKM 3: Pengrajin Lain / Tambahan -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden flex flex-col justify-between transform hover:-translate-y-2 hover:shadow-md transition-all duration-300">
                <div>
                    <div class="h-48 bg-slate-200 relative">
                        <img src="{{ asset('images/umkm-kerajinan.jpg') }}" alt="UMKM Kerajinan" class="w-full h-full object-cover">
                        <span class="absolute bottom-3 left-3 bg-purple-600/90 text-white text-[10px] font-bold px-2 py-0.5 rounded-md backdrop-blur-xs">
                            Kategori: Souvenir / Kreatif
                        </span>
                    </div>
                    <div class="p-6 space-y-2">
                        <h4 class="font-bold text-lg text-slate-900 leading-tight">Cendera Mata Parengan</h4>
                        <p class="text-xs text-slate-500 font-medium flex items-center gap-1">
                            📍 Lingkungan Balai Desa, RT 01/RW 03
                        </p>
                        <p class="text-xs text-slate-600 leading-relaxed pt-2">
                            Pusat pembuatan produk kerajinan turunan kain tenun, seperti tas etnik, dompet, pouch, dan aksesoris souvenir khas bermotif lokal.
                        </p>
                    </div>
                </div>
                <div class="p-6 pt-0 border-t border-slate-50 mt-4 flex items-center justify-between">
                    <span class="text-[11px] font-bold text-slate-400">Pemilik: Bpk. Slamet</span>
                    <a href="https://wa.me/628xxxxxxxxxx" target="_blank" class="inline-flex items-center gap-1 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-3 py-1.5 rounded-lg transition shadow-xs">
                        💬 Hubungi
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection