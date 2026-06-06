@extends('layouts.admin')

@section('title', 'Kelola Aparatur Desa')
@section('page_title', 'Aparatur Desa')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Struktur Aparatur Desa</h2>
            <p class="text-xs text-slate-500">Kelola informasi nama, jabatan, dan foto perangkat Desa Parengan agar struktur organisasi akurat.</p>
        </div>
        <a href="{{ route('admin.aparatur.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#1A365D] hover:bg-blue-950 text-white text-xs font-bold shadow-sm transition">
            <i class="fa-solid fa-user-plus"></i> Tambah Perangkat Desa
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-400 text-[11px] font-bold tracking-wider uppercase">
                        <th class="py-4 px-6 w-16 text-center">No</th>
                        <th class="py-4 px-6 w-24 text-center">Foto</th>
                        <th class="py-4 px-6">Nama Lengkap</th>
                        <th class="py-4 px-6">Jabatan / Posisi</th>
                        <th class="py-4 px-6 w-28 text-center">Urutan</th>
                        <th class="py-4 px-6 w-32 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-4 px-6 text-center font-medium text-slate-500">1</td>
                        <td class="py-4 px-6">
                            <div class="w-12 h-12 rounded-full overflow-hidden bg-slate-100 border border-slate-200 mx-auto shadow-inner">
                                <img src="https://ui-avatars.com/api/?name=Slamet+Rosyidin&background=1A365D&color=fff" alt="Foto Perangkat" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <p class="font-bold text-slate-900">Slamet Rosyidin</p>
                            <span class="text-[11px] text-slate-400 font-medium">-</span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-block px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 font-bold text-[10px] uppercase tracking-wide">Kepala Desa</span>
                        </td>
                        <td class="py-4 px-6 text-center font-semibold text-slate-600">1</td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center gap-2">
                                <button class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-600 flex items-center justify-center text-xs transition" title="Edit Data">
                                    <i class="fa-solid fa-user-pen"></i>
                                </button>
                                <button class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 flex items-center justify-center text-xs transition" title="Hapus">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-4 px-6 text-center font-medium text-slate-500">2</td>
                        <td class="py-4 px-6">
                            <div class="w-12 h-12 rounded-full overflow-hidden bg-slate-100 border border-slate-200 mx-auto shadow-inner">
                                <img src="https://ui-avatars.com/api/?name=Ahmad+Fauzi&background=047857&color=fff" alt="Foto Perangkat" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <p class="font-bold text-slate-900">Ahmad Fauzi, S.Kom</p>
                            <span class="text-[11px] text-slate-400 font-medium">-</span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-block px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 font-bold text-[10px] uppercase tracking-wide">Sekretaris Desa</span>
                        </td>
                        <td class="py-4 px-6 text-center font-semibold text-slate-600">2</td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center gap-2">
                                <button class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-600 flex items-center justify-center text-xs transition" title="Edit Data">
                                    <i class="fa-solid fa-user-pen"></i>
                                </button>
                                <button class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 flex items-center justify-center text-xs transition" title="Hapus">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        
        <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex items-center justify-between text-xs font-medium text-slate-500">
            <span>Menampilkan 2 dari 2 aparatur desa</span>
        </div>
    </div>
@endsection