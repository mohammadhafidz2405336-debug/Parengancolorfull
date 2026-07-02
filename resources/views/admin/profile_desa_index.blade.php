@extends('layouts.admin')

@section('title', 'Kelola Profil & Kependudukan Desa')
@section('page_title', 'Profil & Data Desa')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

    <div class="mb-6">
        <h2 class="text-xl font-bold text-slate-900">Form Integrasi Kelola Profil Parengan</h2>
        <p class="text-xs text-slate-500">Kelola informasi publik, gambar background, visi & misi, hingga statistik kependudukan dalam satu halaman terpadu.</p>
    </div>

    <!-- PANEL IMPORT EXCEL UNTUK BAGIAN KEPENDUDUKAN -->
    <div class="max-w-4xl mb-6">
        <div class="bg-gradient-to-br from-slate-50 to-slate-100 rounded-2xl border border-slate-200 p-6 shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
                <div>
                    <h3 class="text-xs font-extrabold uppercase tracking-wider text-[#1A365D] flex items-center gap-2">
                        <i class="fa-solid fa-file-excel text-emerald-600 text-sm"></i> Isi Otomatis Sektor Kependudukan via Excel
                    </h3>
                    <p class="text-[11px] text-slate-500 mt-1">Gunakan template untuk mempermudah pengisian tabulasi kependudukan secara instan.</p>
                </div>
                <button type="button" onclick="unduhTemplatExcel()" class="shrink-0 px-4 py-2 border border-slate-300 hover:border-[#1A365D] bg-white text-slate-700 hover:text-[#1A365D] rounded-xl text-xs font-bold transition flex items-center gap-2 shadow-sm">
                    <i class="fa-solid fa-download"></i> Unduh Templat Excel
                </button>
            </div>
            <div id="drop-zone" class="border-2 border-dashed border-slate-300 hover:border-emerald-500 bg-white rounded-xl p-6 text-center cursor-pointer transition group">
                <input type="file" id="excel-file" accept=".xlsx, .xls" class="hidden">
                <i class="fa-solid fa-cloud-arrow-up text-3xl text-slate-400 group-hover:text-emerald-500 transition mb-2"></i>
                <p class="text-xs font-bold text-slate-700">Pilih file Excel atau seret (*drag*) ke sini</p>
            </div>
            <div id="excel-success-alert" class="hidden mt-3 p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-semibold flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-emerald-600"></i>
                <span id="excel-file-name">File Excel berhasil dimasukkan ke form kependudukan di bawah.</span>
            </div>
        </div>
    </div>

    <!-- Navigasi Tab Utama -->
    <div class="flex border-b border-slate-200 mb-6 gap-2 overflow-x-auto">
        <button onclick="switchTab('tab-profil')" id="btn-tab-profil" class="tab-btn px-4 py-2.5 font-semibold text-xs uppercase tracking-wider border-b-2 border-[#1A365D] text-[#1A365D] outline-none transition flex items-center gap-2 whitespace-nowrap">
            <i class="fa-solid fa-info-circle"></i> Profil Umum & Foto
        </button>
        <button onclick="switchTab('tab-visimisi')" id="btn-tab-visimisi" class="tab-btn px-4 py-2.5 font-semibold text-xs uppercase tracking-wider border-b-2 border-transparent text-slate-400 hover:text-slate-600 outline-none transition flex items-center gap-2 whitespace-nowrap">
            <i class="fa-solid fa-bullseye"></i> Visi & Misi
        </button>
        <button onclick="switchTab('tab-utama')" id="btn-tab-utama" class="tab-btn px-4 py-2.5 font-semibold text-xs uppercase tracking-wider border-b-2 border-transparent text-slate-400 hover:text-slate-600 outline-none transition flex items-center gap-2 whitespace-nowrap">
            <i class="fa-solid fa-users"></i> Statistik Demografi & KK
        </button>
        <button onclick="switchTab('tab-agama')" id="btn-tab-agama" class="tab-btn px-4 py-2.5 font-semibold text-xs uppercase tracking-wider border-b-2 border-transparent text-slate-400 hover:text-slate-600 outline-none transition flex items-center gap-2 whitespace-nowrap">
            <i class="fa-solid fa-mosque"></i> Agama
        </button>
        <button onclick="switchTab('tab-pendidikan')" id="btn-tab-pendidikan" class="tab-btn px-4 py-2.5 font-semibold text-xs uppercase tracking-wider border-b-2 border-transparent text-slate-400 hover:text-slate-600 outline-none transition flex items-center gap-2 whitespace-nowrap">
            <i class="fa-solid fa-graduation-cap"></i> Pendidikan
        </button>
        <button onclick="switchTab('tab-umur')" id="btn-tab-umur" class="tab-btn px-4 py-2.5 font-semibold text-xs uppercase tracking-wider border-b-2 border-transparent text-slate-400 hover:text-slate-600 outline-none transition flex items-center gap-2 whitespace-nowrap">
            <i class="fa-solid fa-cake-candles"></i> Rentang Umur
        </button>
    </div>

    <!-- SATU FORM BESAR UNTUK MENGIRIMKAN SEMUA DATA -->
    <div class="max-w-4xl">
        <form action="{{ route('admin.profile_desa.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 space-y-6">
            @csrf
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <ul class="text-sm text-red-700 font-semibold">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="p-4 mb-4 text-xs text-emerald-800 rounded-xl bg-emerald-50 border border-emerald-200 font-bold">
                    {{ session('success') }}
                </div>
            @endif

            <!-- ================= TAB: PROFIL UMUM & FOTO ================= -->
            <div id="tab-profil" class="tab-content space-y-6">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 tracking-wider mb-2">Deskripsi Umum Profil Desa</label>
                    <textarea name="deskripsi_umum" rows="6" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none text-sm focus:border-[#1A365D] transition">{{ old('deskripsi_umum', $profile->deskripsi_umum) }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 tracking-wider mb-2">Foto Utama Banner Halaman Profil</label>
                    @if($profile->foto_utama)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $profile->foto_utama) }}" class="w-48 h-auto rounded-xl shadow-sm border">
                        </div>
                    @endif
                    <input type="file" name="foto_utama" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                </div>
            </div>

            <!-- ================= TAB: VISI & MISI ================= -->
            <div id="tab-visimisi" class="tab-content hidden space-y-6">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 tracking-wider mb-2">Visi Desa</label>
                    <textarea name="visi" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none text-sm focus:border-[#1A365D] transition">{{ old('visi', $profile->visi) }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 tracking-wider mb-2">Misi Desa</label>
                    <textarea name="misi" rows="8" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none text-sm focus:border-[#1A365D] transition" placeholder="Contoh:&#10;Mewujudkan tata kelola desa yang bersih&#10;Membina dan memberikan fasilitas pelatihan&#10;Mengembangkan potensi Desa Wisata">{{ old('misi', $profile->misi) }}</textarea>
                    
                    <div class="mt-3 p-3 bg-blue-50 border border-blue-100 rounded-xl">
                        <p class="text-[11px] text-blue-800 font-semibold leading-relaxed">
                            <i class="fa-solid fa-circle-info mr-1"></i> <strong>Cara Isi Misi:</strong> 
                            Cukup ketik poin misi, lalu tekan <strong>"Enter"</strong> untuk baris baru. 
                            Sistem akan otomatis memberikan tanda titik (bullet point) di website.
                        </p>
                    </div>
                </div>
            </div>

            <!-- ================= TAB: UTAMA & GENDER ================= -->
            <div id="tab-utama" class="tab-content hidden space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-500 tracking-wider mb-2">Laki-Laki (Jiwa)</label>
                        <input type="number" name="jumlah_laki" id="jumlah_laki" value="{{ old('jumlah_laki', $profile->jumlah_laki) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 outline-none text-sm font-semibold focus:bg-white focus:border-[#1A365D] transition match-total">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-500 tracking-wider mb-2">Perempuan (Jiwa)</label>
                        <input type="number" name="jumlah_perempuan" id="jumlah_perempuan" value="{{ old('jumlah_perempuan', $profile->jumlah_perempuan) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 outline-none text-sm font-semibold focus:bg-white focus:border-[#1A365D] transition match-total">
                    </div>
                </div>
                <hr class="border-slate-100">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 tracking-wider mb-2">Total Penduduk Terkunci (Jiwa)</label>
                        <input type="number" id="total_jiwa" readonly class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-100 text-slate-600 font-bold outline-none text-sm cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-500 tracking-wider mb-2">Total Kepala Keluarga (KK)</label>
                        <input type="number" name="total_kk" id="total_kk" value="{{ old('total_kk', $profile->total_kk) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 outline-none text-sm font-semibold focus:bg-white focus:border-[#1A365D] transition">
                    </div>
                </div>
            </div>

            <!-- ================= TAB: AGAMA ================= -->
            <div id="tab-agama" class="tab-content hidden space-y-4">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-xs font-extrabold uppercase tracking-wider text-[#1A365D]">Pemeluk Agama & Kepercayaan</h3>
                    <span id="status-agama" class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600">Checking...</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <label class="text-xs font-bold text-slate-600">Islam</label>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" name="agama_islam" id="input_islam" value="{{ old('agama_islam', $profile->agama_islam) }}" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-agama">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right pr-1" id="pct-islam">0%</span>
                        </div>
                    </div>
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <label class="text-xs font-bold text-slate-600">Kristen</label>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" name="agama_kristen" id="input_kristen" value="{{ old('agama_kristen', $profile->agama_kristen) }}" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-agama">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right pr-1" id="pct-kristen">0%</span>
                        </div>
                    </div>
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <label class="text-xs font-bold text-slate-600">Katolik</label>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" name="agama_katolik" id="input_katolik" value="{{ old('agama_katolik', $profile->agama_katolik) }}" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-agama">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right pr-1" id="pct-katolik">0%</span>
                        </div>
                    </div>
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <label class="text-xs font-bold text-slate-600">Agama Lainnya</label>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" name="agama_lainnya" id="input_lainnya" value="{{ old('agama_lainnya', $profile->agama_lainnya) }}" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-agama">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right pr-1" id="pct-lainnya">0%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================= TAB: PENDIDIKAN ================= -->
            <div id="tab-pendidikan" class="tab-content hidden space-y-4">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-xs font-extrabold uppercase tracking-wider text-[#1A365D]">Tingkat Pendidikan Terakhir</h3>
                    <span id="status-pendidikan" class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600">Checking...</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <label class="text-xs font-bold text-slate-600">Tidak / Belum Sekolah</label>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" name="pndk_belum_sekolah" id="input_pndk1" value="{{ old('pndk_belum_sekolah', $profile->pndk_belum_sekolah) }}" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-pndk">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right" id="pct-pndk1">0%</span>
                        </div>
                    </div>
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <label class="text-xs font-bold text-slate-600">SD / Sederajat</label>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" name="pndk_sd" id="input_pndk2" value="{{ old('pndk_sd', $profile->pndk_sd) }}" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-pndk">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right" id="pct-pndk2">0%</span>
                        </div>
                    </div>
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <label class="text-xs font-bold text-slate-600">SMP / Sederajat</label>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" name="pndk_smp" id="input_pndk3" value="{{ old('pndk_smp', $profile->pndk_smp) }}" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-pndk">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right" id="pct-pndk3">0%</span>
                        </div>
                    </div>
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <label class="text-xs font-bold text-slate-600">SMA / Sederajat</label>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" name="pndk_sma" id="input_pndk4" value="{{ old('pndk_sma', $profile->pndk_sma) }}" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-pndk">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right" id="pct-pndk4">0%</span>
                        </div>
                    </div>
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <label class="text-xs font-bold text-slate-600">Diploma / Sarjana</label>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" name="pndk_sarjana" id="input_pndk5" value="{{ old('pndk_sarjana', $profile->pndk_sarjana) }}" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-pndk">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right" id="pct-pndk5">0%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================= TAB: RENTANG UMUR ================= -->
            <div id="tab-umur" class="tab-content hidden space-y-4">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-xs font-extrabold uppercase tracking-wider text-[#1A365D]">Segmentasi Umur</h3>
                    <span id="status-umur" class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600">Checking...</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <div>
                            <span class="block text-xs font-bold text-slate-700">Anak-Anak</span>
                            <span class="text-[10px] text-slate-400">0 - 14 Tahun</span>
                        </div>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" name="umur_anak" id="input_umur1" value="{{ old('umur_anak', $profile->umur_anak) }}" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-umur">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right" id="pct-umur1">0%</span>
                        </div>
                    </div>
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <div>
                            <span class="block text-xs font-bold text-slate-700">Usia Produktif</span>
                            <span class="text-[10px] text-slate-400">15 - 64 Tahun</span>
                        </div>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" name="umur_produktif" id="input_umur2" value="{{ old('umur_produktif', $profile->umur_produktif) }}" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-umur">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right" id="pct-umur2">0%</span>
                        </div>
                    </div>
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <div>
                            <span class="block text-xs font-bold text-slate-700">Lansia</span>
                            <span class="text-[10px] text-slate-400">65+ Tahun</span>
                        </div>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" name="umur_lansia" id="input_umur3" value="{{ old('umur_lansia', $profile->umur_lansia) }}" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-umur">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right" id="pct-umur3">0%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Submit Akhir -->
            <div class="border-t border-slate-100 pt-6 flex items-center justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#1A365D] hover:bg-blue-950 text-white text-xs font-bold shadow-md transition flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Seluruh Profil Desa
                </button>
            </div>
        </form>
    </div>

    <!-- SCRIPT TABULASI & FRONTEND ENGINE EXCEL -->
    <script>
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('excel-file');
        dropZone.addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', (e) => e.target.files.length > 0 && prosesExcel(e.target.files[0]));

        function prosesExcel(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const data = new Uint8Array(e.target.result);
                const workbook = XLSX.read(data, {type: 'array'});
                const row = XLSX.utils.sheet_to_json(workbook.Sheets[workbook.SheetNames[0]])[0];
                
                if (row) {
                    if(row['Laki-Laki'] !== undefined) document.getElementById('jumlah_laki').value = row['Laki-Laki'];
                    if(row['Perempuan'] !== undefined) document.getElementById('jumlah_perempuan').value = row['Perempuan'];
                    if(row['Total KK'] !== undefined) document.getElementById('total_kk').value = row['Total KK'];
                    if(row['Islam'] !== undefined) document.getElementById('input_islam').value = row['Islam'];
                    if(row['Kristen'] !== undefined) document.getElementById('input_kristen').value = row['Kristen'];
                    if(row['Katolik'] !== undefined) document.getElementById('input_katolik').value = row['Katolik'];
                    if(row['Agama Lainnya'] !== undefined) document.getElementById('input_lainnya').value = row['Agama Lainnya'];
                    if(row['Belum Sekolah'] !== undefined) document.getElementById('input_pndk1').value = row['Belum Sekolah'];
                    if(row['SD'] !== undefined) document.getElementById('input_pndk2').value = row['SD'];
                    if(row['SMP'] !== undefined) document.getElementById('input_pndk3').value = row['SMP'];
                    if(row['SMA'] !== undefined) document.getElementById('input_pndk4').value = row['SMA'];
                    if(row['Sarjana'] !== undefined) document.getElementById('input_pndk5').value = row['Sarjana'];
                    if(row['Anak-Anak'] !== undefined) document.getElementById('input_umur1').value = row['Anak-Anak'];
                    if(row['Usia Produktif'] !== undefined) document.getElementById('input_umur2').value = row['Usia Produktif'];
                    if(row['Lansia'] !== undefined) document.getElementById('input_umur3').value = row['Lansia'];

                    window.refreshKalkulasiHalaman();
                    document.getElementById('excel-file-name').innerText = `Berhasil memuat kependudukan dari: "${file.name}"`;
                    document.getElementById('excel-success-alert').classList.remove('hidden');
                }
            };
            reader.readAsArrayBuffer(file);
        }

        function unduhTemplatExcel() {
            const dataTemplat = [{
                'Laki-Laki': 1690, 'Perempuan': 1730, 'Total KK': 984,
                'Islam': 3400, 'Kristen': 15, 'Katolik': 5, 'Agama Lainnya': 0,
                'Belum Sekolah': 500, 'SD': 1200, 'SMP': 900, 'SMA': 700, 'Sarjana': 120,
                'Anak-Anak': 650, 'Usia Produktif': 2300, 'Lansia': 470
            }];
            const worksheet = XLSX.utils.json_to_sheet(dataTemplat);
            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, "Data Demografi");
            XLSX.writeFile(workbook, "templat_kelola_kependudukan_desa.xlsx");
        }

        function switchTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.getElementById(tabId).classList.remove('hidden');
            document.querySelectorAll('.tab-btn').forEach(el => {
                el.classList.remove('border-[#1A365D]', 'text-[#1A365D]');
                el.classList.add('border-transparent', 'text-slate-400');
            });
            const activeBtn = document.getElementById('btn-' + tabId);
            activeBtn.classList.remove('border-transparent', 'text-slate-400');
            activeBtn.classList.add('border-[#1A365D]', 'text-[#1A365D]');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const inLaki = document.getElementById('jumlah_laki');
            const inPerempuan = document.getElementById('jumlah_perempuan');
            const inTotal = document.getElementById('total_jiwa');

            window.refreshKalkulasiHalaman = function() {
                const laki = parseInt(inLaki.value) || 0;
                const perempuan = parseInt(inPerempuan.value) || 0;
                const total = laki + perempuan;
                inTotal.value = total;

                prosesSektor('group-agama', 'status-agama', 'pct-', total);
                prosesSektor('group-pndk', 'status-pendidikan', 'pct-pndk', total);
                prosesSektor('group-umur', 'status-umur', 'pct-umur', total);
            }

            function prosesSektor(inputClassName, statusId, prefixPctId, totalJiwa) {
                const inputs = document.querySelectorAll('.' + inputClassName);
                let subTotal = 0;
                inputs.forEach(input => subTotal += (parseInt(input.value) || 0));

                const statusEl = document.getElementById(statusId);
                if (subTotal === totalJiwa) {
                    statusEl.innerText = "✓ Sinkron";
                    statusEl.className = "text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-200";
                } else {
                    statusEl.innerText = `⚠ Selisih ${Math.abs(totalJiwa - subTotal)} Jiwa`;
                    statusEl.className = "text-[10px] font-bold px-2 py-0.5 rounded-full bg-rose-50 text-rose-600 border border-rose-200";
                }

                inputs.forEach((input, index) => {
                    const val = parseInt(input.value) || 0;
                    const pct = totalJiwa > 0 ? ((val / totalJiwa) * 100).toFixed(1) : 0;
                    if(inputClassName === 'group-agama') {
                        const namaAgama = ['islam', 'kristen', 'katolik', 'lainnya'];
                        document.getElementById('pct-' + namaAgama[index]).innerText = pct + '%';
                    } else {
                        const pctEl = document.getElementById(prefixPctId + (index + 1));
                        if(pctEl) pctEl.innerText = pct + '%';
                    }
                });
            }

            document.querySelectorAll('.match-total, .group-agama, .group-pndk, .group-umur').forEach(input => {
                input.addEventListener('input', window.refreshKalkulasiHalaman);
            });

            window.refreshKalkulasiHalaman();
        });
    </script>
@endsection