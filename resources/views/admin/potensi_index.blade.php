@extends('layouts.admin')

@section('title', 'Kelola Potensi Desa')
@section('page_title', 'Potensi & UMKM')

@section('content')
    @if(session('success'))
        <div class="mb-5 px-4 py-3 bg-emerald-50 text-emerald-600 border border-emerald-200 rounded-xl text-sm font-semibold flex items-center gap-2 animate-fade-in shadow-xs">
            <i class="fa-solid fa-circle-check text-emerald-500"></i>
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-600 rounded-xl text-xs font-semibold space-y-1 shadow-xs">
            <p class="font-bold text-sm flex items-center gap-1.5"><i class="fa-solid fa-triangle-exclamation"></i> Terjadi Kesalahan:</p>
            <ul class="list-disc list-inside pl-1 text-red-500">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="space-y-4 mb-8">
        <div class="border-b border-slate-200 pb-2 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
            <div>
                <h3 class="text-sm font-extrabold uppercase tracking-wider text-blue-950 flex items-center gap-2">
                    <i class="fa-solid fa-table-columns text-amber-500"></i> Section 1: Edit Informasi Potensi Unggulan Desa
                </h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Panel ini terikat langsung ke grid kanan-kiri halaman depan website publik. Perubahan akan langsung menimpa template utama.</p>
            </div>
            <span class="px-2 py-0.5 rounded-md bg-amber-50 text-amber-700 font-bold text-[9px] uppercase border border-amber-200 tracking-wider w-max">
                📌 Mode Grid Dua Kolom
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <div class="bg-white rounded-2xl border border-slate-200 shadow-xs p-5 sm:p-6 flex flex-col justify-between">
                <form action="{{ route('admin.potensi.save_unggulan') }}" method="POST" enctype="multipart/form-data" class="space-y-4 flex-grow flex flex-col justify-between">
                    @csrf
                    <input type="hidden" name="slot" value="kiri">
                    
                    <div class="space-y-3">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-2 mb-2">
                            <span class="text-xs font-bold text-blue-900 uppercase flex items-center gap-1.5">
                                <i class="fa-solid fa-left-long text-blue-500"></i> 1. Komponen Sisi Kiri
                            </span>
                            <span class="px-2 py-0.5 rounded bg-blue-50 text-blue-600 text-[9px] font-extrabold border border-blue-200 uppercase">Slot Kiri</span>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Nama Potensi Kiri <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" value="{{ old('nama', $unggulanKiri->nama ?? '') }}" 
                                   class="w-full px-3 py-1.5 rounded-xl border border-slate-200 text-xs focus:outline-hidden focus:border-blue-800 transition font-bold text-slate-900 shadow-2xs" 
                                   placeholder="Contoh: Kain Tenun Ikat Parengan" required>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Kategori / Label Sektor</label>
                            <input type="text" name="kategori" value="{{ old('kategori', $unggulanKiri->kategori ?? '') }}" 
                                   class="w-full px-3 py-1.5 rounded-xl border border-slate-200 text-xs focus:outline-hidden focus:border-blue-800 transition font-medium text-slate-800 shadow-2xs" 
                                   placeholder="Contoh: Warisan Budaya / Tekstil">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Sejarah Singkat / Deskripsi Narasi <span class="text-red-500">*</span></label>
                            <textarea name="deskripsi" rows="4" 
                                      class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-hidden focus:border-blue-800 transition font-medium text-slate-700 leading-relaxed shadow-2xs" 
                                      placeholder="Tuliskan kisah sejarah kerajinan atau keunikan lokal..." required>{{ old('deskripsi', $unggulanKiri->deskripsi ?? '') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Gambar Cover Sisi Kiri</label>
                            <div class="flex items-center gap-3 p-2 bg-slate-50 border border-slate-100 rounded-xl">
                                <div class="w-12 h-12 rounded-lg border border-slate-200 overflow-hidden shrink-0 bg-slate-200 flex items-center justify-center shadow-2xs">
                                    @if($unggulanKiri && $unggulanKiri->foto)
                                        <img src="{{ asset('storage/' . $unggulanKiri->foto) }}" class="w-full h-full object-cover">
                                    @else
                                        <i class="fa-solid fa-image text-slate-400"></i>
                                    @endif
                                </div>
                                <input type="file" name="foto" class="text-[11px] text-slate-500 file:mr-2 file:py-0.5 file:px-2 file:rounded file:border-0 file:text-[9px] file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-3 mt-4 border-t border-slate-100">
                        <button type="submit" class="px-4 py-1.5 bg-blue-900 hover:bg-blue-950 text-white text-[11px] font-bold rounded-lg shadow-sm transition flex items-center gap-1">
                            <i class="fa-solid fa-floppy-disk"></i> Perbarui Sisi Kiri
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-xs p-5 sm:p-6 flex flex-col justify-between">
                <form action="{{ route('admin.potensi.save_unggulan') }}" method="POST" enctype="multipart/form-data" class="space-y-4 flex-grow flex flex-col justify-between">
                    @csrf
                    <input type="hidden" name="slot" value="kanan">
                    
                    <div class="space-y-3">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-2 mb-2">
                            <span class="text-xs font-bold text-purple-900 uppercase flex items-center gap-1.5">
                                <i class="fa-solid fa-right-long text-purple-500"></i> 2. Komponen Sisi Kanan
                            </span>
                            <span class="px-2 py-0.5 rounded bg-purple-50 text-purple-600 text-[9px] font-extrabold border border-purple-200 uppercase">Slot Kanan</span>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Nama Potensi Kanan <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" value="{{ old('nama', $unggulanKanan->nama ?? '') }}" 
                                   class="w-full px-3 py-1.5 rounded-xl border border-slate-200 text-xs focus:outline-hidden focus:border-blue-800 transition font-bold text-slate-900 shadow-2xs" 
                                   placeholder="Contoh: Kuliner Jajanan Tradisional" required>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Kategori / Label Sektor</label>
                            <input type="text" name="kategori" value="{{ old('kategori', $unggulanKanan->kategori ?? '') }}" 
                                   class="w-full px-3 py-1.5 rounded-xl border border-slate-200 text-xs focus:outline-hidden focus:border-blue-800 transition font-medium text-slate-800 shadow-2xs" 
                                   placeholder="Contoh: Olahan Pangan / Kuliner">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Sejarah Singkat / Deskripsi Narasi <span class="text-red-500">*</span></label>
                            <textarea name="deskripsi" rows="4" 
                                      class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-hidden focus:border-blue-800 transition font-medium text-slate-700 leading-relaxed shadow-2xs" 
                                      placeholder="Tuliskan kisah sejarah kerajinan atau keunikan lokal..." required>{{ old('deskripsi', $unggulanKanan->deskripsi ?? '') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Gambar Cover Sisi Kanan</label>
                            <div class="flex items-center gap-3 p-2 bg-slate-50 border border-slate-100 rounded-xl">
                                <div class="w-12 h-12 rounded-lg border border-slate-200 overflow-hidden shrink-0 bg-slate-200 flex items-center justify-center shadow-2xs">
                                    @if($unggulanKanan && $unggulanKanan->foto)
                                        <img src="{{ asset('storage/' . $unggulanKanan->foto) }}" class="w-full h-full object-cover">
                                    @else
                                        <i class="fa-solid fa-image text-slate-400"></i>
                                    @endif
                                </div>
                                <input type="file" name="foto" class="text-[11px] text-slate-500 file:mr-2 file:py-0.5 file:px-2 file:rounded file:border-0 file:text-[9px] file:font-bold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-3 mt-4 border-t border-slate-100">
                        <button type="submit" class="px-4 py-1.5 bg-purple-900 hover:bg-purple-950 text-white text-[11px] font-bold rounded-lg shadow-sm transition flex items-center gap-1">
                            <i class="fa-solid fa-floppy-disk"></i> Perbarui Sisi Kanan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div id="panel-umkm-form" class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden p-6 mb-8">
        <div class="mb-5 border-b border-slate-100 pb-3 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-extrabold uppercase tracking-wider text-blue-900 flex items-center gap-2">
                    <i class="fa-solid fa-store text-emerald-500"></i> 
                    {{ $umkmEdit ? 'Form Mode: Edit Data Direktori UMKM' : 'Section 2: Daftarkan Data UMKM Warga Baru' }}
                </h3>
                <p class="text-[11px] text-slate-400 mt-1">Gunakan panel ini untuk mengelola list baris tabel direktori produk-produk milik warga desa di bagian bawah web.</p>
            </div>
            @if($umkmEdit)
                <a href="{{ route('admin.potensi.index') }}" class="px-2.5 py-1 rounded-md bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-[10px] uppercase border border-slate-300 transition">
                    ❌ Batalkan Edit
                </a>
            @endif
        </div>

        <form action="{{ route('admin.potensi.save_umkm') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @if($umkmEdit)
                <input type="hidden" name="umkm_id" value="{{ $umkmEdit->id }}">
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1.5">Nama Usaha / UMKM <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama', $umkmEdit->nama ?? '') }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-hidden focus:border-blue-800 transition font-semibold text-slate-800" placeholder="Contoh: Kripik Tempe Renyah Jaya" required>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1.5">Kategori Usaha <span class="text-red-500">*</span></label>
                    <input type="text" name="kategori" value="{{ old('kategori', $umkmEdit->kategori ?? '') }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-hidden focus:border-blue-800 transition font-medium text-slate-800" placeholder="Contoh: Kuliner / Camilan" required>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1.5">Nama Pemilik Usaha <span class="text-red-500">*</span></label>
                    <input type="text" name="pemilik" value="{{ old('pemilik', $umkmEdit->pemilik ?? '') }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-hidden focus:border-blue-800 transition font-medium text-slate-800" placeholder="Contoh: Ibu Aminah" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1.5">Lokasi / Alamat Lengkap Toko <span class="text-red-500">*</span></label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $umkmEdit->lokasi ?? '') }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-hidden focus:border-blue-800 transition font-medium text-slate-800" placeholder="Contoh: RT 03 / RW 01, Depan Balai Desa" required>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1.5">Titik Koordinat GPS <span class="text-slate-400">(Opsional)</span></label>
                    <div class="flex gap-1.5">
                        <div class="relative flex-1">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-2.5 text-slate-400 text-[10px]">
                                <i class="fa-solid fa-location-dot"></i>
                            </span>
                            <input type="text" id="input-koordinat" name="koordinat" value="{{ old('koordinat', $umkmEdit->koordinat ?? '') }}" class="w-full pl-7 pr-2 py-2 rounded-xl border border-slate-200 text-xs focus:outline-hidden focus:border-blue-800 transition font-medium text-slate-800" placeholder="-7.123456, 112.123456">
                        </div>
                        <button type="button" onclick="ambilKoordinatGps()" class="px-2.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-[11px] font-bold transition flex items-center gap-1 shadow-xs shrink-0" title="Ambil lokasi perangkat saat ini">
                            <i class="fa-solid fa-crosshairs animate-pulse"></i> Pin GPS
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1.5">No. WhatsApp Aktif (Format Angka) <span class="text-red-500">*</span></label>
                    <input type="text" name="kontak" value="{{ old('kontak', $umkmEdit->kontak ?? '') }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-hidden focus:border-blue-800 transition font-medium text-slate-800" placeholder="Contoh: 628123456789" required>
                </div>
            </div>

            <div>
                <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1.5">Keterangan / Deskripsi Singkat Produk <span class="text-red-500">*</span></label>
                <textarea name="deskripsi" rows="3" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-hidden focus:border-blue-800 transition font-medium leading-relaxed text-slate-700" placeholder="Jelaskan mengenai menu andalan, kelebihan usaha, atau jam buka toko warga..." required>{{ old('deskripsi', $umkmEdit->deskripsi ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1.5">Foto Sampul / Tempat Usaha UMKM</label>
                <div class="flex items-center gap-4">
                    @if($umkmEdit && $umkmEdit->foto)
                        <div class="w-16 h-16 rounded-xl border border-slate-200 overflow-hidden shrink-0">
                            <img src="{{ asset('storage/' . $umkmEdit->foto) }}" class="w-full h-full object-cover">
                        </div>
                    @endif
                    <input type="file" name="foto" class="text-xs text-slate-500 file:mr-3 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[10px] file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100" accept="image/*">
                </div>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" class="px-4 py-2 {{ $umkmEdit ? 'bg-amber-600 hover:bg-amber-700' : 'bg-emerald-600 hover:bg-emerald-700' }} text-white text-xs font-bold rounded-xl shadow-xs transition flex items-center gap-1">
                    <i class="fa-solid fa-floppy-disk"></i> {{ $umkmEdit ? 'Simpan Perubahan UMKM' : 'Daftarkan UMKM Baru' }}
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
            <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-700"><i class="fa-solid fa-list-check mr-1"></i> Database Direktori UMKM Warga</h4>
            <a href="#panel-umkm-form" class="text-[11px] text-blue-700 font-bold hover:underline">Tambah Data Baru &rarr;</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-400 text-[11px] font-bold tracking-wider uppercase">
                        <th class="py-4 px-6 w-12 text-center">No</th>
                        <th class="py-4 px-6">Foto</th>
                        <th class="py-4 px-6">Nama UMKM</th>
                        <th class="py-4 px-6">Kategori</th>
                        <th class="py-4 px-6">Pemilik & Kontak</th>
                        <th class="py-4 px-6">Alamat / Lokasi</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse($umkmList as $index => $item)
                    <tr class="hover:bg-slate-50/60 transition duration-150">
                        <td class="py-4 px-6 font-bold text-slate-400 text-center">{{ $index + 1 }}</td>
                        <td class="py-4 px-6">
                            <div class="w-12 h-12 rounded-lg border border-slate-100 overflow-hidden bg-slate-100 flex items-center justify-center">
                                @if($item->foto)
                                    <img src="{{ Str::startsWith($item->foto, ['http://', 'https://']) ? $item->foto : asset('storage/' . $item->foto) }}" class="w-full h-full object-cover">
                                @else
                                    <i class="fa-solid fa-store text-slate-300 text-sm"></i>
                                @endif
                            </div>
                        </td>
                        <td class="py-4 px-6 font-bold text-slate-800">{{ $item->nama }}</td>
                        <td class="py-4 px-6">
                            <span class="px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 font-bold text-[10px] border border-blue-100">
                                {{ $item->kategori }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="text-slate-700 font-semibold">{{ $item->pemilik }}</div>
                            <div class="text-[10px] text-emerald-600 mt-0.5"><i class="fa-brands fa-whatsapp"></i> +{{ $item->kontak }}</div>
                        </td>
                        <td class="py-4 px-6 text-slate-500 font-normal">
                            📍 {{ $item->lokasi }}
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.potensi.index', ['edit_umkm_id' => $item->id]) }}#panel-umkm-form" class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-600 flex items-center justify-center text-xs transition" title="Ubah Data">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.potensi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data UMKM ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 flex items-center justify-center text-xs transition" title="Hapus Usaha">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-slate-400">Belum ada data direktori UMKM warga yang didaftarkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-slate-50 px-6 py-4 border-t border-slate-100 flex items-center justify-between text-xs font-medium text-slate-500">
            <span>Menampilkan {{ $umkmList->count() }} UMKM Terdaftar</span>
        </div>
    </div>

    <script>
    function ambilKoordinatGps() {
        const inputKoordinat = document.getElementById('input-koordinat');
        
        if (navigator.geolocation) {
            inputKoordinat.placeholder = "Melacak posisi GPS...";
            
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    
                    // Isi nilai ke input dengan format: latitude, longitude
                    inputKoordinat.value = `${latitude}, ${longitude}`;
                    inputKoordinat.placeholder = "-7.123456, 112.123456";
                    alert("📍 Sukses! Koordinat lokasi toko berhasil dikunci.");
                }, 
                function(error) {
                    inputKoordinat.placeholder = "-7.123456, 112.123456";
                    switch(error.code) {
                        case error.PERMISSION_DENIED:
                            alert("⚠️ Gagal: Akses GPS diblokir browser. Silakan izinkan lokasi di pengaturan browser Anda.");
                            break;
                        case error.POSITION_UNAVAILABLE:
                            alert("⚠️ Gagal: Informasi sinyal GPS tidak tersedia.");
                            break;
                        case error.TIMEOUT:
                            alert("⚠️ Gagal: Waktu pencarian lokasi habis.");
                            break;
                        default:
                            alert("⚠️ Gagal mengambil koordinat lokasi.");
                    }
                },
                {
                    enableHighAccuracy: true, // Memaksa akurasi tinggi (GPS HP/Perangkat)
                    timeout: 7000,
                    maximumAge: 0
                }
            );
        } else {
            alert("❌ Browser Anda tidak mendukung fitur pelacak lokasi GPS.");
        }
    }
</script>
@endsection