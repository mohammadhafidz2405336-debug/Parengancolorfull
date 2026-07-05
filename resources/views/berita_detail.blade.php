@extends('layouts.app')

@section('title', $berita->judul)

@section('content')
<div class="bg-[#F8FAFC] text-slate-800 min-h-screen pb-20 font-sans antialiased">
    
    <div class="bg-white border-b border-slate-200/80 py-4.5 shadow-sm sticky top-0 z-20 backdrop-blur-md bg-white/90">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2.5 text-xs font-bold text-slate-400 uppercase tracking-wider">
                <a href="{{ route('desa.home') }}" class="hover:text-[#1A365D] transition-colors duration-200">Beranda</a>
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('desa.berita') }}" class="hover:text-[#1A365D] transition-colors duration-200">Berita</a>
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                <span class="text-[#1A365D] font-black truncate max-w-[180px] sm:max-w-xs">Detail Artikel</span>
            </nav>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">
            
            <article class="lg:col-span-2 bg-white rounded-3xl border border-slate-200/70 shadow-sm overflow-hidden p-6 sm:p-10 transition-all duration-300 hover:shadow-md">
                
                <div class="space-y-4 mb-6">
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 border border-blue-100 text-blue-700 text-[11px] font-extrabold uppercase tracking-widest shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-600 mr-2 animate-pulse"></span>
                        {{ $berita->kategori }}
                    </span>
                    
                    <h1 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight leading-tight">
                        {{ $berita->judul }}
                    </h1>
                    
                    <div class="flex items-center gap-4 border-y border-slate-100 py-3.5 my-4">
                        <div class="w-10 h-10 rounded-full bg-[#1A365D] flex items-center justify-center text-white text-sm font-bold shadow-sm">
                            {{ strtoupper(substr($berita->penulis, 0, 2)) }}
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Kontributor</p>
                            <p class="text-sm font-bold text-slate-800">{{ $berita->instansi }}</p>
                        </div>
                        <div class="ml-auto text-right sm:block hidden">
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Diterbitkan</p>
                            <p class="text-sm font-semibold text-slate-600">{{ $berita->created_at->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="relative aspect-video rounded-2xl overflow-hidden bg-slate-100 border border-slate-200/60 shadow-inner group mb-8">
                    <img src="{{ $berita->gambar }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover group-hover:scale-102 transition duration-700 ease-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent pointer-events-none"></div>
                </div>

                <div class="text-slate-700 text-base sm:text-[17px] leading-relaxed font-normal tracking-wide space-y-6">
                    @foreach(explode("\n", $berita->isi_berita) as $paragraf)
                        @if(trim($paragraf) !== '')
                            <p class="text-justify [text-indent:2.5rem]">{{ trim($paragraf) }}</p>
                        @endif
                    @endforeach
                </div>

                <div class="mt-12 p-6 bg-slate-50 rounded-2xl border border-slate-100">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div>
                            <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Pewarta:</p>
                            <p class="text-sm font-bold text-slate-800">{{ $berita->pewarta ?? 'Redaksi' }}</p>
                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-100 mt-10 pt-6 ...">

                <div class="border-t border-slate-100 mt-10 pt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <a href="{{ route('desa.berita') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-slate-200 hover:border-[#1A365D] hover:bg-slate-50 text-slate-600 hover:text-[#1A365D] text-xs font-black uppercase tracking-wider transition-all duration-200">
                        <i class="fa-solid fa-arrow-left-long"></i> Kembali ke Semua Berita
                    </a>
                    
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Bagikan :</span>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' - ' . Request::url()) }}" target="_blank" class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white flex items-center justify-center text-sm transition-all duration-200 shadow-sm" title="Bagikan ke WhatsApp">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" target="_blank" class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white flex items-center justify-center text-sm transition-all duration-200 shadow-sm" title="Bagikan ke Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </div>
                </div>

            </article>

            <aside class="space-y-6 lg:sticky lg:top-24">
                <div class="bg-white rounded-3xl border border-slate-200/70 shadow-sm p-6 transition-all duration-300 hover:shadow-md">
                    
                    <h2 class="text-xs font-black uppercase tracking-widest text-slate-900 border-b border-slate-100 pb-3.5 mb-5 flex items-center gap-2.5">
                        <span class="w-2 h-4 bg-[#1A365D] rounded-md"></span>
                        Artikel Terbaru
                    </h2>
                    
                    <div class="space-y-5">
                        @forelse($beritaTerbaru as $terbaru)
                        <a href="{{ route('desa.berita.show', $terbaru->id) }}" class="flex gap-4 group items-start border-b border-slate-50 pb-4 last:border-0 last:pb-0">
                            <div class="w-20 aspect-square rounded-xl overflow-hidden bg-slate-100 border border-slate-200/50 flex-shrink-0 relative shadow-sm">
                                <img src="{{ $terbaru->gambar }}" alt="{{ $terbaru->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            </div>
                            
                            <div class="min-w-0 flex flex-col justify-between h-full">
                                <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-wider mb-1 block">{{ $terbaru->kategori }}</span>
                                <h3 class="text-xs sm:text-sm font-bold text-slate-800 line-clamp-2 group-hover:text-blue-700 transition-colors duration-200 leading-snug mb-1">
                                    {{ $terbaru->judul }}
                                </h3>
                                <div class="flex items-center gap-1.5 text-[10px] text-slate-400 font-medium mt-auto">
                                    <i class="fa-regular fa-calendar-days"></i>
                                    <span>{{ $terbaru->created_at->translatedFormat('d M Y') }}</span>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="text-center py-6">
                            <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-2 text-slate-300">
                                <i class="fa-regular fa-folder-open text-lg"></i>
                            </div>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Belum ada rilis berita lain</p>
                        </div>
                        @endforelse
                    </div>
                </div>

            </aside>

        </div>
    </div>
</div>
@endsection