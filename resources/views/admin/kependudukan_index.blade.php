@extends('layouts.admin')

@section('title', 'Kelola Kependudukan')
@section('page_title', 'Data Kependudukan')

@section('content')
    <!-- Menambahkan Library SheetJS via CDN untuk Simulasi Membaca File Excel di Frontend -->
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

    <!-- Judul Halaman -->
    <div class="mb-6">
        <h2 class="text-xl font-bold text-slate-900">Perbarui Data Kependudukan</h2>
        <p class="text-xs text-slate-500">Gunakan fitur import Excel untuk memperbarui seluruh data demografi desa secara instan dan otomatis.</p>
    </div>

    <!-- ================= FITUR BARU: PANEL IMPORT EXCEL ================= -->
    <div class="max-w-4xl mb-6">
        <div class="bg-gradient-to-br from-slate-50 to-slate-100 rounded-2xl border border-slate-200 p-6 shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
                <div>
                    <h3 class="text-xs font-extrabold uppercase tracking-wider text-[#1A365D] flex items-center gap-2">
                        <i class="fa-solid fa-file-excel text-emerald-600 text-sm"></i> Import Data via Excel
                    </h3>
                    <p class="text-[11px] text-slate-500 mt-1">Isi data pada templat Excel yang disediakan, lalu unggah ke sini agar formulir terisi otomatis.</p>
                </div>
                <!-- Tombol Unduh Templat -->
                <button type="button" onclick="unduhTemplatExcel()" class="shrink-0 px-4 py-2 border border-slate-300 hover:border-[#1A365D] bg-white text-slate-700 hover:text-[#1A365D] rounded-xl text-xs font-bold transition flex items-center gap-2 shadow-sm">
                    <i class="fa-solid fa-download"></i> Unduh Templat Excel
                </button>
            </div>

            <!-- Area Drag & Drop File -->
            <div id="drop-zone" class="border-2 border-dashed border-slate-300 hover:border-emerald-500 bg-white rounded-xl p-6 text-center cursor-pointer transition group">
                <input type="file" id="excel-file" accept=".xlsx, .xls" class="hidden">
                <i class="fa-solid fa-cloud-arrow-up text-3xl text-slate-400 group-hover:text-emerald-500 transition mb-2"></i>
                <p class="text-xs font-bold text-slate-700">Pilih file Excel atau seret (*drag*) ke sini</p>
                <p class="text-[10px] text-slate-400 mt-1">Format file yang didukung: .xlsx, .xls</p>
            </div>
            
            <!-- Notifikasi File Berhasil Dimuat -->
            <div id="excel-success-alert" class="hidden mt-3 p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-semibold flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-emerald-600"></i>
                <span id="excel-file-name">File Excel berhasil dibaca! Seluruh form di bawah telah terisi.</span>
            </div>
        </div>
    </div>

    <!-- Navigasi Tab Internal Form -->
    <div class="flex border-b border-slate-200 mb-6 gap-2 overflow-x-auto">
        <button onclick="switchTab('tab-utama')" id="btn-tab-utama" class="tab-btn px-4 py-2.5 font-semibold text-xs uppercase tracking-wider border-b-2 border-[#1A365D] text-[#1A365D] outline-none transition flex items-center gap-2 whitespace-nowrap">
            <i class="fa-solid fa-users"></i> Statistik & Gender
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

    <!-- Form Kontainer Utama -->
    <div class="max-w-4xl">
        <form id="form-kependudukan" action="#" method="POST" onsubmit="event.preventDefault(); alert('Simulasi: Form final disubmit!');" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 space-y-6">
            @csrf

            <!-- ================= TAB 1: UTAMA & GENDER ================= -->
            <div id="tab-utama" class="tab-content space-y-6">
                <div>
                    <h3 class="text-xs font-extrabold uppercase tracking-wider text-[#1A365D] mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-venus-mars"></i> Distribusi Jenis Kelamin
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-500 tracking-wider mb-2">Laki-Laki (Jiwa)</label>
                            <input type="number" id="jumlah_laki" value="1690" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 outline-none text-sm font-semibold focus:bg-white focus:border-[#1A365D] transition match-total">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-500 tracking-wider mb-2">Perempuan (Jiwa)</label>
                            <input type="number" id="jumlah_perempuan" value="1730" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 outline-none text-sm font-semibold focus:bg-white focus:border-[#1A365D] transition match-total">
                        </div>
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
                        <input type="number" id="total_kk" value="984" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 outline-none text-sm font-semibold focus:bg-white focus:border-[#1A365D] transition">
                    </div>
                </div>
            </div>

            <!-- ================= TAB 2: AGAMA ================= -->
            <div id="tab-agama" class="tab-content hidden space-y-4">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-xs font-extrabold uppercase tracking-wider text-[#1A365D] flex items-center gap-2">
                        <i class="fa-solid fa-mosque"></i> Pemeluk Agama & Kepercayaan
                    </h3>
                    <span id="status-agama" class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600">Checking...</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <label class="text-xs font-bold text-slate-600">Islam</label>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" id="input_islam" value="3400" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-agama">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right pr-1" id="pct-islam">0%</span>
                        </div>
                    </div>
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <label class="text-xs font-bold text-slate-600">Kristen Protestan</label>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" id="input_kristen" value="15" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-agama">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right pr-1" id="pct-kristen">0%</span>
                        </div>
                    </div>
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <label class="text-xs font-bold text-slate-600">Katolik</label>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" id="input_katolik" value="5" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-agama">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right pr-1" id="pct-katolik">0%</span>
                        </div>
                    </div>
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <label class="text-xs font-bold text-slate-600">Hindu / Buddha / Konghucu</label>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" id="input_lainnya" value="0" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-agama">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right pr-1" id="pct-lainnya">0%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================= TAB 3: PENDIDIKAN ================= -->
            <div id="tab-pendidikan" class="tab-content hidden space-y-4">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-xs font-extrabold uppercase tracking-wider text-[#1A365D] flex items-center gap-2">
                        <i class="fa-solid fa-graduation-cap"></i> Tingkat Pendidikan Tertinggi
                    </h3>
                    <span id="status-pendidikan" class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600">Checking...</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <label class="text-xs font-bold text-slate-600">Tidak / Belum Sekolah</label>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" id="input_pndk1" value="500" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-pndk">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right" id="pct-pndk1">0%</span>
                        </div>
                    </div>
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <label class="text-xs font-bold text-slate-600">SD / Sederajat</label>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" id="input_pndk2" value="1200" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-pndk">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right" id="pct-pndk2">0%</span>
                        </div>
                    </div>
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <label class="text-xs font-bold text-slate-600">SMP / Sederajat</label>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" id="input_pndk3" value="900" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-pndk">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right" id="pct-pndk3">0%</span>
                        </div>
                    </div>
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <label class="text-xs font-bold text-slate-600">SMA / Sederajat</label>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" id="input_pndk4" value="700" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-pndk">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right" id="pct-pndk4">0%</span>
                        </div>
                    </div>
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <label class="text-xs font-bold text-slate-600">Diploma / Sarjana (D1-S3)</label>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" id="input_pndk5" value="120" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-pndk">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right" id="pct-pndk5">0%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================= TAB 4: RENTANG UMUR ================= -->
            <div id="tab-umur" class="tab-content hidden space-y-4">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-xs font-extrabold uppercase tracking-wider text-[#1A365D] flex items-center gap-2">
                        <i class="fa-solid fa-cake-candles"></i> Segmentasi Berdasarkan Umur
                    </h3>
                    <span id="status-umur" class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600">Checking...</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <div>
                            <span class="block text-xs font-bold text-slate-700">Anak-Anak</span>
                            <span class="text-[10px] text-slate-400">0 - 14 Tahun</span>
                        </div>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" id="input_umur1" value="650" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-umur">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right" id="pct-umur1">0%</span>
                        </div>
                    </div>
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <div>
                            <span class="block text-xs font-bold text-slate-700">Usia Produktif</span>
                            <span class="text-[10px] text-slate-400">15 - 64 Tahun</span>
                        </div>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" id="input_umur2" value="2300" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-umur">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right" id="pct-umur2">0%</span>
                        </div>
                    </div>
                    <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between gap-4">
                        <div>
                            <span class="block text-xs font-bold text-slate-700">Lansia</span>
                            <span class="text-[10px] text-slate-400">65+ Tahun</span>
                        </div>
                        <div class="flex items-center gap-2 w-32 shrink-0">
                            <input type="number" id="input_umur3" value="470" class="w-full px-2 py-1.5 border border-slate-200 bg-white rounded-lg text-xs font-bold text-right outline-none group-umur">
                            <span class="text-[10px] font-medium text-slate-400 w-10 text-right" id="pct-umur3">0%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Simpan -->
            <div class="border-t border-slate-100 pt-6 flex items-center justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#1A365D] hover:bg-blue-950 text-white text-xs font-bold shadow-md transition flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Sektor Ini
                </button>
            </div>
        </form>
    </div>

    <!-- ================= JAVASCRIPT LOGIKAL EXCEL & INTERAKSI ================= -->
    <script>
        // A. Pemicu Klik Drop Zone Excel
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('excel-file');

        dropZone.addEventListener('click', () => fileInput.click());

        fileInput.addEventListener('change', function(e) {
            if(e.target.files.length > 0) prosesExcel(e.target.files[0]);
        });

        // B. Logika Inti Membaca Excel di Sisi Klien (Frontend Parsing)
        function prosesExcel(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const data = new Uint8Array(e.target.result);
                const workbook = XLSX.read(data, {type: 'array'});
                
                // Ambil sheet pertama dari file Excel
                const firstSheetName = workbook.SheetNames[0];
                const worksheet = workbook.Sheets[firstSheetName];
                
                // Konversi isi baris Excel ke JSON
                const jsonData = XLSX.utils.sheet_to_json(worksheet);
                
                if (jsonData.length > 0) {
                    const row = jsonData[0]; // Kita ambil baris data pertama setelah header
                    
                    // Isi Otomatis Form dengan mencocokkan Nama Kolom di Excel
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

                    // Picu ulang fungsi hitung persentase dan sinkronisasi
                    window.refreshKalkulasiHalaman();

                    // Tampilkan Info Berhasil
                    document.getElementById('excel-file-name').innerText = `Berhasil memuat data dari: "${file.name}"`;
                    document.getElementById('excel-success-alert').classList.remove('hidden');
                }
            };
            reader.readAsArrayBuffer(file);
        }

        // C. Fitur Membuat & Mengunduh Templat Excel Otomatis (.xlsx)
        function unduhTemplatExcel() {
            // Skema struktur data yang disesuaikan dengan form website
            const dataTemplat = [{
                'Laki-Laki': 1690, 'Perempuan': 1730, 'Total KK': 984,
                'Islam': 3400, 'Kristen': 15, 'Katolik': 5, 'Agama Lainnya': 0,
                'Belum Sekolah': 500, 'SD': 1200, 'SMP': 900, 'SMA': 700, 'Sarjana': 120,
                'Anak-Anak': 650, 'Usia Produktif': 2300, 'Lansia': 470
            }];
            
            const worksheet = XLSX.utils.json_to_sheet(dataTemplat);
            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, "Data Demografi");
            
            // Simpan file Excel langsung ke komputer admin
            XLSX.writeFile(workbook, "templat_kelola_kependudukan_desa.xlsx");
        }

        // D. Sistem Navigasi Tab
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

        // E. Logika Kalkulator Persentase & Validasi Real-time
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
                    statusEl.innerText = "✓ Sinkron dengan total penduduk";
                    statusEl.className = "text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-200";
                } else {
                    const selisih = totalJiwa - subTotal;
                    statusEl.innerText = `⚠ Selisih ${Math.abs(selisih)} Jiwa (${selisih > 0 ? 'Kurang' : 'Lebih'})`;
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