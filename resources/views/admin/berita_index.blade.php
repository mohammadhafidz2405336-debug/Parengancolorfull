@extends('layouts.admin')

@section('title', 'Kelola Berita')
@section('page_title', 'Berita Desa')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Manajemen Berita Desa</h2>
            <p class="text-xs text-slate-500">Tambah, ubah, atau hapus artikel berita yang dipublikasikan ke warga.</p>
        </div>
        <a href="{{ route('admin.berita.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#1A365D] hover:bg-blue-950 text-white text-xs font-bold shadow-sm transition">
            <i class="fa-solid fa-plus"></i> Tambah Berita Baru
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-400 text-[11px] font-bold tracking-wider uppercase">
                        <th class="py-4 px-6 w-16 text-center">No</th>
                        <th class="py-4 px-6 w-32">Gambar</th>
                        <th class="py-4 px-6">Judul Berita & Kategori</th>
                        <th class="py-4 px-6 w-40">Penulis / Tanggal</th>
                        <th class="py-4 px-6 w-36 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-4 px-6 text-center font-medium text-slate-500">1</td>
                        <td class="py-4 px-6">
                            <div class="w-24 aspect-video rounded-lg overflow-hidden bg-slate-100 border border-slate-200">
                                <img src="{{ asset('images/berita/stunting.jpg') }}" alt="Thumbnail" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-block px-2 py-0.5 rounded bg-blue-50 text-blue-600 font-bold text-[10px] uppercase tracking-wide mb-1">Kesehatan</span>
                            <h3 class="font-bold text-slate-900 line-clamp-1 hover:text-blue-700 transition">“Rembuk Stunting Desa Parengan 2026: Perkuat Komitmen Bersama Cegah Kasus Sejak Dini”</h3>
                        </td>
                        <td class="py-4 px-6">
                            <p class="font-semibold text-slate-800 text-xs">Pemdes</p>
                            <span class="text-[11px] text-slate-400 font-medium">05 Mei 2026</span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center gap-2">
                                <button class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-600 flex items-center justify-center text-xs transition" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 flex items-center justify-center text-xs transition" title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-4 px-6 text-center font-medium text-slate-500">2</td>
                        <td class="py-4 px-6">
                            <div class="w-24 aspect-video rounded-lg overflow-hidden bg-slate-100 border border-slate-200">
                                <img src="{{ asset('images/berita/lingkungan.jpg') }}" alt="Thumbnail" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-block px-2 py-0.5 rounded bg-emerald-50 text-emerald-600 font-bold text-[10px] uppercase tracking-wide mb-1">Lingkungan</span>
                            <h3 class="font-bold text-slate-900 line-clamp-1 hover:text-blue-700 transition">“Gerakan Hijau Lestari: Kolaborasi Pemdes dan Warga Tanam Ratusan Bibit Pohon”</h3>
                        </td>
                        <td class="py-4 px-6">
                            <p class="font-semibold text-slate-800 text-xs">Karang Taruna</p>
                            <span class="text-[11px] text-slate-400 font-medium">02 Mei 2026</span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center gap-2">
                                <button class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-600 flex items-center justify-center text-xs transition" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 flex items-center justify-center text-xs transition" title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        
        <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex items-center justify-between text-xs font-medium text-slate-500">
            <span>Menampilkan 2 dari 2 berita desa</span>
            <div class="flex items-center gap-1">
                <button class="px-2.5 py-1.5 rounded border border-slate-200 bg-white hover:bg-slate-50 disabled:opacity-50 transition" disabled>Sebelumnya</button>
                <button class="px-2.5 py-1.5 rounded border border-slate-200 bg-white hover:bg-slate-50 disabled:opacity-50 transition" disabled>Selanjutnya</button>
            </div>
        </div>
    </div>
@endsection