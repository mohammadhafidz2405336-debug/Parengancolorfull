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

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm rounded-xl">
            {{ session('success') }}
        </div>
    @endif

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
                    @forelse($allBerita as $index => $item)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-4 px-6 text-center font-medium text-slate-500">{{ $index + 1 }}</td>
                        <td class="py-4 px-6">
                            <div class="w-24 aspect-video rounded-lg overflow-hidden bg-slate-100 border border-slate-200">
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="Thumbnail" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-block px-2 py-0.5 rounded bg-blue-50 text-blue-600 font-bold text-[10px] uppercase tracking-wide mb-1">{{ $item->kategori }}</span>
                            <h3 class="font-bold text-slate-900 line-clamp-1">“{{ $item->judul }}”</h3>
                        </td>
                        <td class="py-4 px-6">
                            <p class="font-semibold text-slate-800 text-xs">{{ $item->penulis }}</p>
                            <span class="text-[11px] text-slate-400 font-medium">{{ $item->created_at->translatedFormat('d M Y') }}</span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center gap-2">
                                <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 flex items-center justify-center text-xs transition" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-slate-400 text-sm">Belum ada berita yang diterbitkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex items-center justify-between text-xs font-medium text-slate-500">
            <span>Menampilkan {{ $allBerita->count() }} berita desa</span>
        </div>
    </div>
@endsection