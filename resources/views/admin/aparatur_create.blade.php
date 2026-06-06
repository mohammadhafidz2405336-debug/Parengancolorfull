@extends('layouts.admin')

@section('title', 'Tambah Aparatur Desa')
@section('page_title', 'Aparatur Desa')

@section('content')
    <!-- Judul & Tombol Kembali -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Tambah Perangkat Desa Baru</h2>
            <p class="text-xs text-slate-500">Daftarkan personel aparatur pemerintah Desa Parengan beserta jabatan resminya.</p>
        </div>
        <a href="{{ route('admin.aparatur.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-600 text-xs font-bold transition shadow-sm">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <!-- Tampilan Alert Box Simulasi -->
    <div id="simulasi-alert" class="hidden max-w-3xl mb-6 flex items-center justify-between p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-medium animate-fade-in">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-circle-check text-base text-emerald-600"></i>
            <span>Simulasi Sukses: Data aparatur baru beserta TUPOKSI & kontak berhasil divalidasi!</span>
        </div>
        <button onclick="document.getElementById('simulasi-alert').classList.add('hidden')" class="text-emerald-500 hover:text-emerald-700 transition">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <!-- Kontainer Utama Form -->
    <div class="max-w-3xl">
        <form id="form-aparatur" action="#" method="POST" enctype="multipart/form-data" onsubmit="event.preventDefault(); jalankanSimulasiAparatur();" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- KOLOM KIRI: UPLOAD FOTO & LIVE PREVIEW -->
                <div class="flex flex-col items-center text-center space-y-4">
                    <label class="block text-xs font-extrabold uppercase text-slate-400 tracking-wider">Foto Aparatur</label>
                    
                    <!-- Lingkaran Preview -->
                    <div class="relative w-36 h-36 rounded-full border-4 border-slate-100 bg-slate-50 flex items-center justify-center overflow-hidden shadow-inner group">
                        <img id="image-preview" src="#" alt="Preview Foto" class="hidden w-full h-full object-cover">
                        <div id="placeholder-icon" class="text-slate-300 flex flex-col items-center">
                            <i class="fa-solid fa-user-tie text-5xl"></i>
                        </div>
                    </div>

                    <!-- Tombol Upload Custom -->
                    <label for="foto" class="px-3 py-1.5 bg-slate-100 hover:bg-[#1A365D] text-slate-600 hover:text-white rounded-lg text-xs font-bold cursor-pointer transition flex items-center gap-1.5 shadow-sm">
                        <i class="fa-solid fa-camera"></i> Pilih Foto
                    </label>
                    <input type="file" id="foto" name="foto" accept="image/jpeg,image/png" class="hidden">
                    <p class="text-[10px] text-slate-400">Rekomendasi rasio 1:1 (Kotak/Square) maks. 2MB</p>
                </div>

                <!-- KOLOM KANAN: INPUT DATA IDENTITAS & KONTAK -->
                <div class="md:grid-cols-1 md:col-span-2 space-y-5">
                    
                    <!-- Input Nama Lengkap -->
                    <div>
                        <label for="nama" class="block text-xs font-bold uppercase text-slate-500 tracking-wider mb-2">Nama Lengkap & Gelar</label>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 text-slate-400 text-sm"><i class="fa-solid fa-user"></i></span>
                            <input type="text" id="nama" name="nama" required placeholder="Contoh: Ahmad Fauzi, S.Kom"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-[#1A365D] focus:ring-2 focus:ring-blue-100 outline-none text-sm font-semibold transition">
                        </div>
                    </div>

                    <!-- Grid Menyejajarkan Jabatan dan Urutan -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- Input Jabatan Perangkat Desa -->
                        <div class="sm:col-span-2">
                            <label for="jabatan" class="block text-xs font-bold uppercase text-slate-500 tracking-wider mb-2">Jabatan Resmi</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-slate-400 text-sm"><i class="fa-solid fa-id-card-clip"></i></span>
                                <select id="jabatan" name="jabatan" required
                                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-[#1A365D] focus:ring-2 focus:ring-blue-100 outline-none text-sm font-semibold transition appearance-none cursor-pointer text-slate-700">
                                    <option value="" disabled selected hidden>Pilih Jabatan Desa...</option>
                                    <option value="Kepala Desa">Kepala Desa</option>
                                    <option value="Sekretaris Desa">Sekretaris Desa</option>
                                    <option value="Kaur Keuangan">Kaur Keuangan (Bendahara)</option>
                                    <option value="Kaur Perencanaan">Kaur Perencanaan</option>
                                    <option value="Kaur Tata Usaha & Umum">Kaur Tata Usaha & Umum</option>
                                    <option value="Kasi Pemerintahan">Kasi Pemerintahan</option>
                                    <option value="Kasi Kesejahteraan">Kasi Kesejahteraan (Kesra)</option>
                                    <option value="Kasi Pelayanan">Kasi Pelayanan</option>
                                    <option value="Kepala Dusun">Kepala Dusun (Kasun)</option>
                                </select>
                                <span class="absolute right-4 text-slate-400 pointer-events-none text-xs"><i class="fa-solid fa-chevron-down"></i></span>
                            </div>
                        </div>

                        <!-- Input Urutan Struktur -->
                        <div>
                            <label for="urutan" class="block text-xs font-bold uppercase text-slate-500 tracking-wider mb-2" title="Menentukan nomor urut bagan">No. Urut Struktur</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-slate-400 text-sm"><i class="fa-solid fa-arrow-down-short-wide"></i></span>
                                <input type="number" id="urutan" name="urutan" required min="1" placeholder="Misal: 2"
                                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-[#1A365D] focus:ring-2 focus:ring-blue-100 outline-none text-sm font-semibold transition">
                            </div>
                        </div>
                    </div>

                    <!-- Input Email Resmi (Sesuai Ikon Oranye di Gambar) -->
                    <div>
                        <label for="email" class="block text-xs font-bold uppercase text-slate-500 tracking-wider mb-2">Email Resmi</label>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 text-amber-500 text-sm"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" id="email" name="email" required placeholder="Contoh: sekdes@parengan.desa.id"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-[#1A365D] focus:ring-2 focus:ring-blue-100 outline-none text-sm font-semibold transition">
                        </div>
                    </div>

                    <!-- Input Jam Pelayanan Kantor (Sesuai Ikon Hijau di Gambar) -->
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-500 tracking-wider mb-2">Jam Pelayanan Kantor</label>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-emerald-500 text-xs font-bold">Mulai</span>
                                <input type="time" id="jam_mulai" name="jam_mulai" required value="08:00"
                                    class="w-full pl-16 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-[#1A365D] focus:ring-2 focus:ring-blue-100 outline-none text-sm font-semibold transition text-slate-700">
                            </div>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-rose-500 text-xs font-bold">Selesai</span>
                                <input type="time" id="jam_selesai" name="jam_selesai" required value="15:00"
                                    class="w-full pl-16 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-[#1A365D] focus:ring-2 focus:ring-blue-100 outline-none text-sm font-semibold transition text-slate-700">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- INPUT TUPOKSI (Paling Bawah - Membentang Penuh) -->
            <div class="border-t border-slate-100 pt-6">
                <label for="tupoksi" class="block text-xs font-bold uppercase text-slate-500 tracking-wider mb-2">Tugas Pokok & Fungsi (Tupoksi)</label>
                <div class="relative">
                    <textarea id="tupoksi" name="tupoksi" required rows="4" 
                        placeholder="Masukkan deskripsi tugas pokok aparatur di sini... (Contoh: Memimpin, mengoordinasikan, dan mengendalikan seluruh kegiatan administrasi desa...)"
                        class="w-full p-4 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-[#1A365D] focus:ring-2 focus:ring-blue-100 outline-none text-sm font-medium transition leading-relaxed text-slate-700"></textarea>
                </div>
            </div>

            <!-- Tombol Pengiriman Akhir Form -->
            <div class="border-t border-slate-100 pt-6 flex items-center justify-end gap-3">
                <a href="{{ route('admin.aparatur.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-600 text-xs font-bold transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#1A365D] hover:bg-blue-950 text-white text-xs font-bold shadow-md transition flex items-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-paper-plane"></i> Tambahkan Perangkat
                </button>
            </div>

        </form>
    </div>

    <!-- ================= SCRIPT INTERAKSI FRONTEND ================= -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('foto');
            const imagePreview = document.getElementById('image-preview');
            const placeholderIcon = document.getElementById('placeholder-icon');

            // Logika Mengubah File Foto menjadi Preview Gambar Instan
            fileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.addEventListener('load', function() {
                        imagePreview.setAttribute('src', this.result);
                        imagePreview.classList.remove('hidden');
                        placeholderIcon.classList.add('hidden');
                    });
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.classList.add('hidden');
                    placeholderIcon.classList.remove('hidden');
                }
            });
        });

        // Jalankan animasi notifikasi tiruan ketika form ditekan simpan
        function jalankanSimulasiAparatur() {
            const alertBox = document.getElementById('simulasi-alert');
            alertBox.classList.remove('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>
@endsection