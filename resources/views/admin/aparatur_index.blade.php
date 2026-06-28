@extends('layouts.admin')

@section('title', 'Kelola Aparatur Desa')
@section('page_title', 'Aparatur Desa')

@section('content')
    <div class="mb-6">
        <h2 class="text-xl font-bold text-slate-900">Struktur Aparatur Desa</h2>
        <p class="text-xs text-slate-500">Sesuaikan informasi nama dan foto perangkat Desa Parengan sesuai dengan pemangku jabatan saat ini.</p>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-400 text-[11px] font-bold tracking-wider uppercase">
                        <th class="py-4 px-6 w-24 text-center">Foto</th>
                        <th class="py-4 px-6">Jabatan Struktural</th>
                        <th class="py-4 px-6">Nama Lengkap Pemangku</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700 text-sm">
                    @foreach($aparatur as $item)
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <td class="py-4 px-6 text-center">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" class="w-12 h-12 rounded-full object-cover inline-block ring-2 ring-slate-100 shadow-sm">
                            @else
                                <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 text-base inline-block shadow-inner pt-2">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            @endif
                        </td>
                        <td class="py-4 px-6 font-semibold text-slate-900">
                            {{ $item->jabatan }}
                        </td>
                        <td class="py-4 px-6">
                            <span class="{{ $item->nama == 'Belum Diatur' ? 'text-rose-500 italic' : 'text-slate-700 font-medium' }}">
                                {{ $item->nama }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center">
                                <a href="{{ route('admin.aparatur.edit', $item->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-50 hover:bg-amber-500 text-amber-700 hover:text-white font-bold text-xs transition-all shadow-sm" title="Edit Data">
                                    <i class="fa-solid fa-user-pen"></i> Edit Perangkat
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection