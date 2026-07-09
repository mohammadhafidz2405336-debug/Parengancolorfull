@extends('layouts.admin')

@section('title', 'Pengaturan Beranda')

@section('content')
<div class="p-6 max-w-5xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Pengaturan Tampilan Beranda</h1>
        <p class="text-sm text-slate-500">Kelola gambar slider, sambutan kades, visi misi, serta informasi kontak beranda.</p>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-800 rounded-xl flex items-center gap-2 text-sm">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.home_setting.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <h2 class="text-base font-bold text-slate-900 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-images text-blue-600"></i> Banner Slider Utama (Maksimal 3 Gambar)
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @for ($i = 1; $i <= 3; $i++)
                    @php
                        // Mengambil path gambar berdasarkan key slot (slot_1, slot_2, slot_3)
                        $slotKey = 'slot_' . $i;
                        $imagePath = isset($setting->hero_images[$slotKey]) ? $setting->hero_images[$slotKey] : null;
                    @endphp
                    
                    <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50 space-y-3">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Gambar Slider - Slot {{ $i }}</label>
                        
                        <div class="relative aspect-video rounded-xl overflow-hidden border border-slate-200 bg-slate-200">
                            @if($imagePath)
                                <img src="{{ \Illuminate\Support\Str::startsWith($imagePath, 'http') ? $imagePath : asset('storage/' . $imagePath) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 text-xs">
                                    <i class="fa-solid fa-image text-xl mb-1"></i>
                                    <span>Menggunakan Default Asset</span>
                                </div>
                            @endif
                        </div>
                        
                        <input type="file" name="hero_images[{{ $slotKey }}]" class="block w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    </div>
                @endfor
            </div>
            <p class="text-xs text-slate-400 italic font-medium mt-3">*Pilih berkas hanya pada slot tertentu untuk mengganti gambar di slot tersebut tanpa mengganggu slot lainnya.</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <h2 class="text-base font-bold text-slate-900 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-user-tie text-blue-600"></i> Profil & Sambutan Kepala Desa
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-600">Nama Kepala Desa</label>
                    <input type="text" name="kades_nama" value="{{ old('kades_nama', $setting->kades_nama) }}" placeholder="Contoh: Bpk. H. Ahmad Sudrajat" class="w-full p-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-600">Masa Jabatan</label>
                    <input type="text" name="kades_masa_jabatan" value="{{ old('kades_masa_jabatan', $setting->kades_masa_jabatan) }}" placeholder="Contoh: 2025 - 2031" class="w-full p-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="space-y-1 md:col-span-1">
                    <label class="text-xs font-semibold text-slate-600">Foto Resmi Kades</label>
                    <input type="file" name="kades_foto" class="block w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 mb-2" />
                    @if($setting->kades_foto)
                        <img src="{{ asset('storage/' . $setting->kades_foto) }}" class="w-24 h-32 object-cover rounded-xl border border-slate-200">
                    @endif
                </div>
                <div class="space-y-1 md:col-span-2">
                    <label class="text-xs font-semibold text-slate-600">Kalimat Teks Sambutan Beranda</label>
                    <textarea name="sambutan" rows="6" placeholder="Tulis kata sambutan kepala desa..." class="w-full p-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500">{{ old('sambutan', $setting->sambutan) }}</textarea>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <h2 class="text-base font-bold text-slate-900 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-list-check text-blue-600"></i> Manajemen Program Kerja Desa
            </h2>
            <div class="space-y-6">
                <!-- Input Program 1 -->
                <div class="p-4 border border-slate-100 rounded-xl bg-slate-50/50 space-y-3">
                    <div class="flex items-center gap-2 font-semibold text-sm text-slate-800">
                        <span>🎨</span> Program 1 (Pengembangan Desa Wisata)
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-600">Judul Program 1</label>
                        <input type="text" name="program_1_judul" value="{{ old('program_1_judul', $setting->program_1_judul ?? 'Pengembangan Desa Wisata') }}" class="w-full p-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-600">Deskripsi Program 1</label>
                        <textarea name="program_1_deskripsi" rows="2" class="w-full p-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500">{{ old('program_1_deskripsi', $setting->program_1_deskripsi) }}</textarea>
                    </div>
                </div>

                <!-- Input Program 2 -->
                <div class="p-4 border border-slate-100 rounded-xl bg-slate-50/50 space-y-3">
                    <div class="flex items-center gap-2 font-semibold text-sm text-slate-800">
                        <span>🧵</span> Program 2 (Digitalisasi Pasar)
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-600">Judul Program 2</label>
                        <input type="text" name="program_2_judul" value="{{ old('program_2_judul', $setting->program_2_judul ?? 'Digitalisasi Pasar') }}" class="w-full p-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-600">Deskripsi Program 2</label>
                        <textarea name="program_2_deskripsi" rows="2" class="w-full p-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500">{{ old('program_2_deskripsi', $setting->program_2_deskripsi) }}</textarea>
                    </div>
                </div>

                <!-- Input Program 3 -->
                <div class="p-4 border border-slate-100 rounded-xl bg-slate-50/50 space-y-3">
                    <div class="flex items-center gap-2 font-semibold text-sm text-slate-800">
                        <span>⚡</span> Program 3 (Smart Governance)
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-600">Judul Program 3</label>
                        <input type="text" name="program_3_judul" value="{{ old('program_3_judul', $setting->program_3_judul ?? 'Smart Governance') }}" class="w-full p-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-600">Deskripsi Program 3</label>
                        <textarea name="program_3_deskripsi" rows="2" class="w-full p-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500">{{ old('program_3_deskripsi', $setting->program_3_deskripsi) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <h2 class="text-base font-bold text-slate-900 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-address-book text-blue-600"></i> Hubungi Kami (Kontak Kaki Beranda)
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-600">Nomor Telepon / WhatsApp</label>
                    <input type="text" name="kontak_telepon" value="{{ old('kontak_telepon', $setting->kontak_telepon) }}" placeholder="Contoh: +62 812-3456-7890" class="w-full p-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-600">Alamat Email Resmi</label>
                    <input type="email" name="kontak_email" value="{{ old('kontak_email', $setting->kontak_email) }}" placeholder="Contoh: info@parengan.desa.id" class="w-full p-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-600">Username Instagram</label>
                    <input type="text" name="kontak_instagram" value="{{ old('kontak_instagram', $setting->kontak_instagram) }}" placeholder="Contoh: @parengancolorfull" class="w-full p-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500">
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <button type="submit" class="px-6 py-2.5 bg-blue-700 text-white rounded-xl text-sm font-semibold shadow-md shadow-blue-700/10 hover:bg-blue-800 transition-all cursor-pointer">
                <i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Seluruh Perubahan
            </button>
        </div>
    </form>
</div>
@endsection