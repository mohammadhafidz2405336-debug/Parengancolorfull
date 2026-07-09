@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard Ringkasan')

@section('content')
    <div class="bg-gradient-to-r from-[#1A365D] to-blue-900 rounded-2xl p-6 text-white mb-8 shadow-md relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-2xl font-bold mb-1">Selamat Datang Kembali, {{ Auth::user()->name }}! 👋</h2>
            <p class="text-blue-200 text-sm max-w-xl">
                Hari ini Anda bisa memantau rangkuman statistik data penduduk, mengelola artikel berita terbaru, serta memantau perkembangan sistem informasi Desa Parengan.
            </p>
        </div>
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/5 rounded-full pointer-events-none"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between group hover:shadow-md transition">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Total Penduduk</span>
                <h3 class="text-3xl font-black text-slate-900">{{ number_format($totalPenduduk) }} <span class="text-xs font-medium text-slate-500">Jiwa</span></h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl group-hover:bg-[#1A365D] group-hover:text-white transition duration-300">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between group hover:shadow-md transition">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Artikel Berita</span>
                <h3 class="text-3xl font-black text-slate-900">{{ number_format($totalBerita) }} <span class="text-xs font-medium text-slate-500">Post</span></h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl group-hover:bg-amber-400 group-hover:text-[#1A365D] transition duration-300">
                <i class="fa-solid fa-newspaper"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between group hover:shadow-md transition">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Aparatur Desa</span>
                <h3 class="text-3xl font-black text-slate-900">{{ number_format($totalAparatur) }} <span class="text-xs font-medium text-slate-500">Staff</span></h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl group-hover:bg-purple-600 group-hover:text-white transition duration-300">
                <i class="fa-solid fa-sitemap"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between group hover:shadow-md transition">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Permohonan Surat</span>
                <h3 class="text-3xl font-black text-slate-900">{{ number_format($totalPermohonan) }} <span class="text-xs font-medium text-slate-500">Berkas</span></h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl group-hover:bg-emerald-600 group-hover:text-white transition duration-300">
                <i class="fa-solid fa-file-invoice"></i>
            </div>
        </div>

    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-4">
            <h4 class="text-base font-bold text-slate-900">Aktivitas Sistem Terakhir</h4>
            <span class="text-xs font-medium text-slate-400">Pembaruan Real-time</span>
        </div>
        
        <div class="space-y-4">
            @forelse($activities as $activity)
                <div class="flex items-start gap-3 text-sm">
                    <span class="w-2 h-2 rounded-full bg-blue-600 mt-1.5 shrink-0"></span>
                    
                    <p class="text-slate-600">{!! $activity->description !!}</p>
                    
                    <span class="text-xs text-slate-400 ml-auto whitespace-nowrap">
                        {{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}
                    </span>
                </div>
            @empty
                <div class="text-center py-6 text-sm text-slate-400 font-medium">
                    <i class="fa-solid fa-clock-rotate-left text-lg block mb-2 text-slate-300"></i>
                    Belum ada aktivitas admin yang tercatat hari ini.
                </div>
            @endforelse
        </div>
    </div>
@endsection