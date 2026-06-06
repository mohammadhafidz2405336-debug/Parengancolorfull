@extends('layouts.admin')

@section('title', 'Kelola Potensi Desa')
@section('page_title', 'Potensi & UMKM')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Daftar Potensi & Produk UMKM</h2>
            <p class="text-xs text-slate-500">Kelola informasi produk lokal warga Desa Parengan agar terpublikasi di halaman depan website utama.</p>
        </div>
        <a href="#" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#1A365D] hover:bg-blue-950 text-white text-xs font-bold shadow-sm transition">
            <i class="fa-solid fa-plus"></i> Daftarkan UMKM Baru
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-400 text-[11px] font-bold tracking-wider uppercase">
                        <th class="py-4 px-6 w-12 text-center">No</th>
                        <th class="py-4 px-6 w-24 text-center">Foto Produk</th>
                        <th class="py-4 px-6">Nama Usaha / Bisnis</th>
                        <th class="py-4 px-6">Kategori Usaha</th>
                        <th class="py-4 px-6">Nama Pemilik</th>
                        <th class="py-4 px-6">Lokasi / Alamat RT-RW</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
                    
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-4 px-6 text-center text-slate-400 font-normal">1</td>
                        <td class="py-4 px-6">
                            <div class="w-14 h-14 rounded-xl bg-slate-100 border border-slate-100 overflow-hidden flex items-center justify-center text-slate-300">
                                <i class="fa-solid fa-image text-lg"></i>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-slate-900 text-sm">Cendera Mata Parengan</div>
                            <div class="text-[10px] text-slate-400 font-normal mt-0.5">Kerajinan turunan tenun ikat khas lokal.</div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-block px-2 py-0.5 rounded-md bg-purple-50 text-purple-700 font-bold text-[10px] uppercase">
                                Souvenir / Kreatif
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="text-slate-900 font-semibold">Bpk. Slamet</div>
                            <div class="text-[10px] text-emerald-600 mt-0.5"><i class="fa-brands fa-whatsapp"></i> +628123456789</div>
                        </td>
                        <td class="py-4 px-6 text-slate-600 font-normal">
                            📍 Lingkungan Balai Desa, RT 01 / RW 03
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center gap-1.5">
                                <button class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-600 flex items-center justify-center text-xs transition" title="Ubah Data">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 flex items-center justify-center text-xs transition" title="Hapus Usaha">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-4 px-6 text-center text-slate-400 font-normal">2</td>
                        <td class="py-4 px-6">
                            <div class="w-14 h-14 rounded-xl bg-slate-100 border border-slate-100 overflow-hidden flex items-center justify-center text-slate-300">
                                <i class="fa-solid fa-image text-lg"></i>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-slate-900 text-sm">Warung Sega Gaber</div>
                            <div class="text-[10px] text-slate-400 font-normal mt-0.5">Kuliner tradisional nasi bungkus daun jati.</div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-block px-2 py-0.5 rounded-md bg-orange-50 text-orange-700 font-bold text-[10px] uppercase">
                                Kuliner / Makanan
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="text-slate-900 font-semibold">Ibu Aminah</div>
                            <div class="text-[10px] text-emerald-600 mt-0.5"><i class="fa-brands fa-whatsapp"></i> +6285711122233</div>
                        </td>
                        <td class="py-4 px-6 text-slate-600 font-normal">
                            📍 Depan Pasar Desa, RT 03 / RW 01
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center gap-1.5">
                                <button class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-600 flex items-center justify-center text-xs transition" title="Ubah Data">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 flex items-center justify-center text-xs transition" title="Hapus Usaha">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        
        <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex items-center justify-between text-xs font-medium text-slate-500">
            <span>Menampilkan 2 UMKM terdaftar</span>
        </div>
    </div>
@endsection