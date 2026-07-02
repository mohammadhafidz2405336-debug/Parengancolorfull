@extends('layouts.app')

@section('title', 'Profile Desa')

@section('content')
<div class="w-full bg-[#F0F4F8] text-slate-900 py-12 px-4 sm:px-6 lg:px-8 min-h-screen">
    <div class="max-w-7xl mx-auto">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16" data-aos="fade-up">
            <div class="space-y-6">
                <h1 class="text-3xl font-black tracking-tight text-slate-900 border-b-4 border-amber-500 pb-2 inline-block">
                    Profil Umum {{ $profileData->nama_desa ?? 'Desa Parengan' }}
                </h1>
                <div class="text-slate-700 leading-relaxed text-justify space-y-4 font-normal">
                    <p>{{ $profileData->deskripsi_umum ?? 'Deskripsi belum diatur oleh admin.' }}</p>
                </div>
            </div>

            <div class="relative" data-aos="zoom-in" data-aos-delay="200">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-amber-400 rounded-2xl blur opacity-20 transform rotate-1"></div>
                <img src="{{ !empty($profileData->foto_utama) ? asset('storage/' . $profileData->foto_utama) : asset('images/bg-parengan.jpg') }}" alt="Profil Desa" class="relative rounded-2xl shadow-xl border border-slate-200 object-cover w-full h-[350px] lg:h-[400px]">
            </div>
        </div>

        <div class="flex justify-center mb-12" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white shadow-sm border border-slate-300 text-sm font-semibold tracking-wide text-slate-700">
                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                Visi & Misi Desa
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20" data-aos="fade-up" data-aos-delay="150">
            <!-- Card Visi -->
            <div class="bg-white border border-slate-100 shadow-sm p-8 rounded-3xl relative overflow-hidden group hover:shadow-lg transition duration-300">
                <div class="absolute top-0 left-0 w-2 h-full bg-blue-600"></div>
                <h2 class="text-2xl font-black text-slate-900 mb-6 flex items-center gap-3">
                    <i class="fa-solid fa-eye text-blue-600"></i> Visi
                </h2>
                <p class="text-slate-700 leading-relaxed text-justify font-medium">
                    {{ $profileData->visi ?? 'Visi belum diatur.' }}
                </p>
            </div>

            <!-- Card Misi -->
            <div class="bg-white border border-slate-100 shadow-sm p-8 rounded-3xl relative overflow-hidden group hover:shadow-lg transition duration-300">
                <div class="absolute top-0 left-0 w-2 h-full bg-amber-400"></div>
                <h2 class="text-2xl font-black text-slate-900 mb-6 flex items-center gap-3">
                    <i class="fa-solid fa-clipboard-list text-amber-500"></i> Misi
                </h2>

                <div class="text-slate-700 leading-relaxed text-justify font-normal">
                    @if(!empty($profileData->misi))
                        {{-- class marker:text-amber-500 akan mewarnai titiknya saja --}}
                        <ul class="list-disc pl-5 space-y-3 marker:text-amber-500">
                            @foreach(explode("\n", str_replace('•', '', $profileData->misi)) as $item)
                                @if(trim($item))
                                    {{-- Text-nya tetap warna slate-700, titiknya berwarna amber --}}
                                    <li class="text-slate-700">{{ trim($item) }}</li>
                                @endif
                            @endforeach
                        </ul>
                    @else
                        <p>Misi belum diatur.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex justify-center mb-6" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white shadow-sm border border-slate-300 text-sm font-semibold tracking-wide text-slate-700">
                <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                Struktur Organisasi
            </span>
        </div>

        <div class="text-center mb-12" data-aos="fade-up">
            <p class="text-sm text-slate-600">Aparat desa yang bertugas melayani masyarakat desa parengan</p>
        </div>

        <!-- STRUKTUR ORGANISASI INTERAKTIF (TETAP SESUAI ASLI) -->
        <div class="w-full flex flex-col items-center overflow-x-auto pb-8" data-aos="fade-up">
            <!-- Kontainer utama -->
            <div class="min-w-[1000px] w-full flex flex-col items-center relative">
                @php
                    $kades = $aparatur->where('jabatan', 'Kepala Desa')->first();
                    $sekdes = $aparatur->where('jabatan', 'Sekretaris Desa')->first();
                    $kaurKeuangan = $aparatur->where('jabatan', 'Kaur Keuangan')->first();
                    $kaurUmum = $aparatur->where('jabatan', 'Kaur Umum')->first();
                    $kasiPemerintahan = $aparatur->where('jabatan', 'Kasi Pemerintahan')->first();
                    $kasiKesra = $aparatur->where('jabatan', 'Kasi Kesejahteraan')->first();
                    $kasiPelayanan = $aparatur->where('jabatan', 'Kasi Pelayanan')->first();
                    $kadusun = $aparatur->where('jabatan', 'Kepala Dusun')->first();
                @endphp

                <!-- 1. KEPALA DESA (Tingkat Paling Atas) -->
                <div class="flex justify-center w-full relative z-10">
                    <div onclick="openModal('Kepala Desa', '{{ $kades->nama ?? 'Belum Diatur' }}', '{{ addslashes($kades->tupoksi ?? 'Tupoksi belum diatur.') }}', '{{ $kades->email ?? '-' }}', '{{ $kades->jam_pelayanan ?? '08:00 - 15:00 WIB' }}', '{{ $kades->foto ?? '' }}')" 
                        class="bg-[#FAFAFA] border border-slate-200 shadow-md p-4 rounded-xl flex items-center gap-4 w-64 cursor-pointer hover:border-blue-500 hover:shadow-lg transition duration-300 group">
                        <div class="w-12 h-12 rounded-full flex-shrink-0 overflow-hidden ring-2 ring-slate-100 shadow-sm flex items-center justify-center bg-slate-200">
                            @if(!empty($kades->foto)) <img src="{{ asset('storage/' . $kades->foto) }}" class="w-full h-full object-cover"> @else <i class="fa-solid fa-user text-slate-400"></i> @endif
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-medium">Kepala Desa</p>
                            <p class="text-sm font-black text-slate-900 group-hover:text-blue-600 transition">{{ $kades->nama ?? 'Belum Diatur' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Garis Turun dari Kepala Desa -->
                <div class="w-0.5 h-8 bg-slate-400"></div>

                <!-- 2. TINGKAT 1 (Kaur Keuangan & Sekretaris Desa) -->
                <div class="w-full relative">
                    <!-- Garis Horizontal Penghubung Kiri & Kanan -->
                    <div class="absolute top-0 left-[25%] w-[50%] h-0.5 bg-slate-400"></div>
                    <!-- Garis Vertikal Turun ke Kaur Keuangan (-translate-x-1/2 ditambahkan) -->
                    <div class="absolute top-0 left-[25%] -translate-x-1/2 w-0.5 h-6 bg-slate-400"></div>
                    <!-- Garis Utama Tengah -->
                    <div class="absolute top-0 left-1/2 -ml-[1px] w-0.5 h-full bg-slate-400"></div>
                    <!-- Garis Vertikal Turun ke Sekretaris Desa (-translate-x-1/2 ditambahkan) -->
                    <div class="absolute top-0 left-[75%] -translate-x-1/2 w-0.5 h-6 bg-slate-400"></div>

                    <div class="grid grid-cols-2 w-full pt-6 relative z-10">
                        <!-- Kaur Keuangan (Kiri) -->
                        <div class="flex justify-center">
                            <div onclick="openModal('Kaur Keuangan', '{{ $kaurKeuangan->nama ?? 'Belum Diatur' }}', '{{ addslashes($kaurKeuangan->tupoksi ?? 'Tupoksi belum diatur.') }}', '{{ $kaurKeuangan->email ?? '-' }}', '{{ $kaurKeuangan->jam_pelayanan ?? '08:00 - 15:00 WIB' }}', '{{ $kaurKeuangan->foto ?? '' }}')" 
                                class="bg-[#FAFAFA] border border-slate-200 shadow-md p-4 rounded-xl flex items-center gap-4 w-64 cursor-pointer hover:border-blue-500 hover:shadow-lg transition duration-300 group">
                                <div class="w-12 h-12 rounded-full flex-shrink-0 overflow-hidden ring-2 ring-slate-100 shadow-sm flex items-center justify-center bg-slate-200">
                                    @if(!empty($kaurKeuangan->foto)) <img src="{{ asset('storage/' . $kaurKeuangan->foto) }}" class="w-full h-full object-cover"> @else <i class="fa-solid fa-user text-slate-400"></i> @endif
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 font-medium">Kaur Keuangan</p>
                                    <p class="text-sm font-black text-slate-900 group-hover:text-blue-600 transition">{{ $kaurKeuangan->nama ?? 'Belum Diatur' }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Sekretaris Desa (Kanan) -->
                        <div class="flex justify-center">
                            <div onclick="openModal('Sekretaris Desa', '{{ $sekdes->nama ?? 'Belum Diatur' }}', '{{ addslashes($sekdes->tupoksi ?? 'Tupoksi belum diatur.') }}', '{{ $sekdes->email ?? '-' }}', '{{ $sekdes->jam_pelayanan ?? '08:00 - 15:00 WIB' }}', '{{ $sekdes->foto ?? '' }}')"
                                class="bg-[#FAFAFA] border border-slate-200 shadow-md p-4 rounded-xl flex items-center gap-4 w-64 cursor-pointer hover:border-blue-500 hover:shadow-lg transition duration-300 group">
                                <div class="w-12 h-12 rounded-full flex-shrink-0 overflow-hidden ring-2 ring-slate-100 shadow-sm flex items-center justify-center bg-slate-200">
                                    @if(!empty($sekdes->foto)) <img src="{{ asset('storage/' . $sekdes->foto) }}" class="w-full h-full object-cover"> @else <i class="fa-solid fa-user text-slate-400"></i> @endif
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 font-medium">Sekretaris Desa</p>
                                    <p class="text-sm font-black text-slate-900 group-hover:text-blue-600 transition">{{ $sekdes->nama ?? 'Belum Diatur' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jarak Garis Vertikal Lanjutan -->
                <div class="w-0.5 h-8 bg-slate-400"></div>

                <!-- 3. TINGKAT 2 (Kepala Dusun) -->
                <div class="w-full relative">
                    <!-- Garis Horizontal Tengah ke Kanan -->
                    <div class="absolute top-0 left-1/2 w-[25%] h-0.5 bg-slate-400"></div>
                    <!-- Garis Utama Tengah -->
                    <div class="absolute top-0 left-1/2 -ml-[1px] w-0.5 h-full bg-slate-400"></div>
                    <!-- Garis Vertikal Turun ke Kepala Dusun (-translate-x-1/2 ditambahkan) -->
                    <div class="absolute top-0 left-[75%] -translate-x-1/2 w-0.5 h-6 bg-slate-400"></div>

                    <div class="grid grid-cols-2 w-full pt-6 relative z-10">
                        <div></div> <!-- Sisi Kiri Kosong -->
                        <!-- Kepala Dusun (Kanan) -->
                        <div class="flex justify-center">
                            <div onclick="openModal('Kepala Dusun', '{{ $kadusun->nama ?? 'Belum Diatur' }}', '{{ addslashes($kadusun->tupoksi ?? 'Tupoksi belum diatur.') }}', '{{ $kadusun->email ?? '-' }}', '{{ $kadusun->jam_pelayanan ?? '24 Jam' }}', '{{ $kadusun->foto ?? '' }}')"
                                class="bg-[#FAFAFA] border border-slate-200 shadow-md p-4 rounded-xl flex items-center gap-4 w-64 cursor-pointer hover:border-blue-500 hover:shadow-lg transition duration-300 group">
                                <div class="w-12 h-12 rounded-full flex-shrink-0 overflow-hidden ring-2 ring-slate-100 shadow-sm flex items-center justify-center bg-slate-200">
                                    @if(!empty($kadusun->foto)) <img src="{{ asset('storage/' . $kadusun->foto) }}" class="w-full h-full object-cover"> @else <i class="fa-solid fa-user text-slate-400"></i> @endif
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 font-medium">Kepala Dusun</p>
                                    <p class="text-sm font-black text-slate-900 group-hover:text-blue-600 transition">{{ $kadusun->nama ?? 'Belum Diatur' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jarak Garis Vertikal Lanjutan -->
                <div class="w-0.5 h-8 bg-slate-400"></div>

                <!-- 4. TINGKAT TERBAWAH (4 Bagian Kasi & Kaur Umum) -->
                <div class="w-full relative">
                    <!-- Garis Horizontal Mencakup 4 Kolom -->
                    <div class="absolute top-0 left-[12.5%] w-[75%] h-0.5 bg-slate-400"></div>
                    <!-- Garis Vertikal ke tiap Node (-translate-x-1/2 ditambahkan) -->
                    <div class="absolute top-0 left-[12.5%] -translate-x-1/2 w-0.5 h-6 bg-slate-400"></div>
                    <div class="absolute top-0 left-[37.5%] -translate-x-1/2 w-0.5 h-6 bg-slate-400"></div>
                    <div class="absolute top-0 left-[62.5%] -translate-x-1/2 w-0.5 h-6 bg-slate-400"></div>
                    <div class="absolute top-0 left-[87.5%] -translate-x-1/2 w-0.5 h-6 bg-slate-400"></div>

                    <!-- Grid 4 Kolom -->
                    <div class="grid grid-cols-4 gap-4 px-4 pt-6 relative z-10 w-full">
                        <!-- 4.1 Kasi Pemerintahan -->
                        <div class="flex justify-center w-full">
                            <div onclick="openModal('Kasi Pemerintahan', '{{ $kasiPemerintahan->nama ?? 'Belum Diatur' }}', '{{ addslashes($kasiPemerintahan->tupoksi ?? 'Tupoksi belum diatur.') }}', '{{ $kasiPemerintahan->email ?? '-' }}', '{{ $kasiPemerintahan->jam_pelayanan ?? '08:00 - 14:00 WIB' }}', '{{ $kasiPemerintahan->foto ?? '' }}')"
                                class="bg-[#FAFAFA] border border-slate-200 shadow-md p-3 rounded-xl flex items-center gap-3 w-full max-w-[220px] cursor-pointer hover:border-blue-500 transition group">
                                <div class="w-10 h-10 rounded-full flex-shrink-0 overflow-hidden ring-2 ring-slate-100 flex items-center justify-center bg-slate-200">
                                    @if(!empty($kasiPemerintahan->foto)) <img src="{{ asset('storage/' . $kasiPemerintahan->foto) }}" class="w-full h-full object-cover"> @else <i class="fa-solid fa-user text-slate-400"></i> @endif
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-[11px] text-slate-500 font-medium truncate">Kasi Pemerintahan</p>
                                    <p class="text-xs font-black text-slate-900 group-hover:text-blue-600 truncate">{{ $kasiPemerintahan->nama ?? 'Belum Diatur' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- 4.2 Kasi Kesejahteraan -->
                        <div class="flex justify-center w-full">
                            <div onclick="openModal('Kasi Kesejahteraan', '{{ $kasiKesra->nama ?? 'Belum Diatur' }}', '{{ addslashes($kasiKesra->tupoksi ?? 'Tupoksi belum diatur.') }}', '{{ $kasiKesra->email ?? '-' }}', '{{ $kasiKesra->jam_pelayanan ?? '08:00 - 14:00 WIB' }}', '{{ $kasiKesra->foto ?? '' }}')"
                                class="bg-[#FAFAFA] border border-slate-200 shadow-md p-3 rounded-xl flex items-center gap-3 w-full max-w-[220px] cursor-pointer hover:border-blue-500 transition group">
                                <div class="w-10 h-10 rounded-full flex-shrink-0 overflow-hidden ring-2 ring-slate-100 flex items-center justify-center bg-slate-200">
                                    @if(!empty($kasiKesra->foto)) <img src="{{ asset('storage/' . $kasiKesra->foto) }}" class="w-full h-full object-cover"> @else <i class="fa-solid fa-user text-slate-400"></i> @endif
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-[11px] text-slate-500 font-medium truncate">Kasi Kesejahteraan</p>
                                    <p class="text-xs font-black text-slate-900 group-hover:text-blue-600 truncate">{{ $kasiKesra->nama ?? 'Belum Diatur' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- 4.3 Kasi Pelayanan -->
                        <div class="flex justify-center w-full">
                            <div onclick="openModal('Kasi Pelayanan', '{{ $kasiPelayanan->nama ?? 'Belum Diatur' }}', '{{ addslashes($kasiPelayanan->tupoksi ?? 'Tupoksi belum diatur.') }}', '{{ $kasiPelayanan->email ?? '-' }}', '{{ $kasiPelayanan->jam_pelayanan ?? '08:00 - 14:00 WIB' }}', '{{ $kasiPelayanan->foto ?? '' }}')"
                                class="bg-[#FAFAFA] border border-slate-200 shadow-md p-3 rounded-xl flex items-center gap-3 w-full max-w-[220px] cursor-pointer hover:border-blue-500 transition group">
                                <div class="w-10 h-10 rounded-full flex-shrink-0 overflow-hidden ring-2 ring-slate-100 flex items-center justify-center bg-slate-200">
                                    @if(!empty($kasiPelayanan->foto)) <img src="{{ asset('storage/' . $kasiPelayanan->foto) }}" class="w-full h-full object-cover"> @else <i class="fa-solid fa-user text-slate-400"></i> @endif
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-[11px] text-slate-500 font-medium truncate">Kasi Pelayanan</p>
                                    <p class="text-xs font-black text-slate-900 group-hover:text-blue-600 truncate">{{ $kasiPelayanan->nama ?? 'Belum Diatur' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- 4.4 Kaur Umum -->
                        <div class="flex justify-center w-full">
                            <div onclick="openModal('Kaur Umum', '{{ $kaurUmum->nama ?? 'Belum Diatur' }}', '{{ addslashes($kaurUmum->tupoksi ?? 'Tupoksi belum diatur.') }}', '{{ $kaurUmum->email ?? '-' }}', '{{ $kaurUmum->jam_pelayanan ?? '08:00 - 15:00 WIB' }}', '{{ $kaurUmum->foto ?? '' }}')"
                                class="bg-[#FAFAFA] border border-slate-200 shadow-md p-3 rounded-xl flex items-center gap-3 w-full max-w-[220px] cursor-pointer hover:border-blue-500 transition group">
                                <div class="w-10 h-10 rounded-full flex-shrink-0 overflow-hidden ring-2 ring-slate-100 flex items-center justify-center bg-slate-200">
                                    @if(!empty($kaurUmum->foto)) <img src="{{ asset('storage/' . $kaurUmum->foto) }}" class="w-full h-full object-cover"> @else <i class="fa-solid fa-user text-slate-400"></i> @endif
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-[11px] text-slate-500 font-medium truncate">Kaur Umum</p>
                                    <p class="text-xs font-black text-slate-900 group-hover:text-blue-600 truncate">{{ $kaurUmum->nama ?? 'Belum Diatur' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PANEL DETAIL (MODAL) -->
        <div id="perangkatModal" class="fixed inset-0 z-50 opacity-0 pointer-events-none bg-slate-900/60 backdrop-blur-sm flex items-center justify-center md:flex md:justify-end transition-opacity duration-300">
            <div id="modalCard" class="bg-white w-full max-w-md shadow-2xl border border-slate-200 overflow-hidden transform transition-all duration-300 ease-out rounded-3xl p-0 mx-4 scale-95 md:h-full md:rounded-none md:mx-0 md:translate-x-full md:scale-100 md:border-l">
                <div class="bg-gradient-to-r from-blue-600 to-sky-500 h-32 relative flex items-end px-6 pb-4">
                    <button onclick="closeModal()" class="absolute top-4 right-4 text-white bg-black/10 hover:bg-black/30 p-2 rounded-full transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg></button>
                </div>
                <div class="flex px-6 -mt-12 relative z-10 md:justify-start justify-center"><div id="modalFotoContainer" class="w-24 h-24 bg-white rounded-full border-4 border-white overflow-hidden shadow-lg flex items-center justify-center"></div></div>
                <div class="p-6 space-y-6 md:text-left text-center">
                    <div><h4 id="modalNama" class="text-2xl font-black text-slate-900"></h4><p id="modalJabatan" class="text-sm font-semibold text-blue-600 tracking-wide bg-blue-50 inline-block px-3 py-1 rounded-full mt-1.5"></p></div>
                    <div class="border-t border-slate-100 pt-5 space-y-4 text-left">
                        <div><span class="text-[11px] uppercase tracking-wider text-slate-400 font-bold block mb-1">Tupoksi</span><p id="modalTupoksi" class="text-sm text-slate-700 leading-relaxed text-justify bg-slate-50 p-3 rounded-xl border border-slate-100"></p></div>
                        <div class="space-y-3 pt-2">
                            <div class="flex items-center gap-3 text-slate-700"><div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center text-amber-600"><i class="fa-solid fa-envelope"></i></div><div><span class="text-[10px] text-slate-400 font-bold block uppercase">Email</span><span id="modalEmail" class="text-sm font-medium text-slate-800"></span></div></div>
                            <div class="flex items-center gap-3 text-slate-700"><div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center text-green-600"><i class="fa-solid fa-clock"></i></div><div><span class="text-[10px] text-slate-400 font-bold block uppercase">Jam Pelayanan</span><span id="modalJam" class="text-sm font-medium text-slate-800"></span></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center mb-12" data-aos="fade-up"><span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white shadow-sm border border-slate-300 text-sm font-semibold tracking-wide text-slate-700"><span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span> Data Statistik Desa</span></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pb-20" data-aos="fade-up">
            <div class="bg-[#FFFFFF] p-6 rounded-3xl shadow-md border border-slate-200 flex flex-col items-center"><h3 class="text-base font-bold text-slate-800 mb-4 w-full px-2">Rasio Penduduk</h3><div class="w-full h-[240px]"><canvas id="chartPenduduk"></canvas></div></div>
            <div class="bg-[#FFFFFF] p-6 rounded-3xl shadow-md border border-slate-200 flex flex-col"><h3 class="text-lg font-bold text-slate-800 mb-4">Komposisi Agama</h3><div class="w-full h-[240px]"><canvas id="chartAgama"></canvas></div></div>
            <div class="bg-[#FFFFFF] p-6 rounded-3xl shadow-md border border-slate-200 flex flex-col items-center"><h3 class="text-base font-bold text-slate-800 mb-4 w-full px-2">Rasio Pendidikan</h3><div class="w-full h-[240px]"><canvas id="chartPendidikan"></canvas></div></div>
            <div class="bg-[#FFFFFF] p-6 rounded-3xl shadow-md border border-slate-200 flex flex-col"><h3 class="text-lg font-bold text-slate-800 mb-4">Rentang Umur</h3><div class="w-full h-[240px]"><canvas id="chartUmur"></canvas></div></div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Konfigurasi warna global agar senada dengan tema website
            const colors = {
                blue: ['#2563eb', '#3b82f6', '#60a5fa', '#93c5fd', '#bed8fe'],
                amber: ['#d97706', '#f59e0b', '#fbbf24', '#fcd34d', '#fef3c7'],
                mixed: ['#2563eb', '#f59e0b', '#10b981', '#ef4444', '#8b5cf6']
            };

            // 1. Chart Rasio Penduduk (Doughnut)
            new Chart(document.getElementById('chartPenduduk'), {
                type: 'doughnut',
                data: {
                    labels: ['Laki-laki', 'Perempuan'],
                    datasets: [{
                        data: [{{ $profileData->jumlah_laki ?? 0 }}, {{ $profileData->jumlah_perempuan ?? 0 }}],
                        backgroundColor: [colors.blue[0], colors.amber[1]],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom' } }
                }
            });

            // 2. Chart Komposisi Agama (Bar)
            new Chart(document.getElementById('chartAgama'), {
                type: 'bar',
                data: {
                    labels: ['Islam', 'Kristen', 'Katolik', 'Lainnya'],
                    datasets: [{
                        label: 'Jumlah Jiwa',
                        data: [{{ $profileData->agama_islam ?? 0 }}, {{ $profileData->agama_kristen ?? 0 }}, {{ $profileData->agama_katolik ?? 0 }}, {{ $profileData->agama_lainnya ?? 0 }}],
                        backgroundColor: colors.blue[1],
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });

            // 3. Chart Rasio Pendidikan (Pie)
            new Chart(document.getElementById('chartPendidikan'), {
                type: 'pie',
                data: {
                    labels: ['Belum Sekolah', 'SD', 'SMP', 'SMA', 'Sarjana'],
                    datasets: [{
                        data: [{{ $profileData->pndk_belum_sekolah ?? 0 }}, {{ $profileData->pndk_sd ?? 0 }}, {{ $profileData->pndk_smp ?? 0 }}, {{ $profileData->pndk_sma ?? 0 }}, {{ $profileData->pndk_sarjana ?? 0 }}],
                        backgroundColor: colors.mixed,
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom' } }
                }
            });

            // 4. Chart Rentang Umur (Line)
            new Chart(document.getElementById('chartUmur'), {
                type: 'line',
                data: {
                    labels: ['Anak', 'Produktif', 'Lansia'],
                    datasets: [{
                        label: 'Jumlah Orang',
                        data: [{{ $profileData->umur_anak ?? 0 }}, {{ $profileData->umur_produktif ?? 0 }}, {{ $profileData->umur_lansia ?? 0 }}],
                        borderColor: colors.amber[0],
                        backgroundColor: 'rgba(217, 119, 6, 0.1)',
                        fill: true,
                        tension: 0.3,
                        borderWidth: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });
        });

        // --- LOGIKA MODAL (Animasi Smooth) ---
        function openModal(jabatan, nama, tupoksi, email, jam, foto) {
            document.getElementById('modalJabatan').innerText = jabatan;
            document.getElementById('modalNama').innerText = nama;
            document.getElementById('modalTupoksi').innerText = tupoksi;
            document.getElementById('modalEmail').innerText = email;
            document.getElementById('modalJam').innerText = jam;

            const fotoContainer = document.getElementById('modalFotoContainer');
            fotoContainer.innerHTML = foto ? 
                `<img src="/storage/${foto}" class="w-full h-full object-cover">` : 
                '<svg class="w-12 h-12 text-slate-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5-3-8-3z" /></svg>';

            const modal = document.getElementById('perangkatModal');
            const card = document.getElementById('modalCard');
            
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100', 'pointer-events-auto');

            setTimeout(() => {
                if (window.innerWidth >= 768) { 
                    card.classList.remove('md:translate-x-full');
                    card.classList.add('md:translate-x-0');
                } else { 
                    card.classList.remove('scale-95');
                    card.classList.add('scale-100');
                }
            }, 50);
        }
        
        function closeModal() {
            const modal = document.getElementById('perangkatModal');
            const card = document.getElementById('modalCard');
            
            if (window.innerWidth >= 768) {
                card.classList.remove('md:translate-x-0');
                card.classList.add('md:translate-x-full');
            } else {
                card.classList.remove('scale-100');
                card.classList.add('scale-95');
            }

            setTimeout(() => {
                modal.classList.remove('opacity-100', 'pointer-events-auto');
                modal.classList.add('opacity-0', 'pointer-events-none');
            }, 250);
        }

        // Klik di luar modal untuk menutup
        window.onclick = function(event) {
            const modal = document.getElementById('perangkatModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</div>
@endsection