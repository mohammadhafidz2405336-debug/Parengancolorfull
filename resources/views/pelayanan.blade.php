@extends('layouts.app')

@section('title', 'Pelayanan Digital')

@section('content')
<!-- ========================================== -->
<!-- HERO SECTION (Tampilan Atas - Gambar Utama) -->
<!-- ========================================== -->
<div class="w-full min-h-[40vh] bg-cover bg-center relative flex flex-col justify-between" 
     style="background-image: url('{{ asset('images/bg-parengan.jpg') }}');">
    <div class="absolute inset-0 bg-black/50 z-0"></div>

    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 flex-grow">
        <!-- Sisi Kiri Hero -->
        <div class="lg:col-span-8 flex flex-col justify-center px-6 sm:px-12 lg:px-20 py-12 text-white" data-aos="fade-right">
            <span class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold uppercase tracking-wider bg-black/20 backdrop-blur-xs px-3 py-1.5 rounded-full w-max mb-3 border border-white/10">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                </span>
                Smart Governance
            </span>
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight leading-tight mb-2 drop-shadow-md">
                Pelayanan Digital Terpadu
            </h1>
            <p class="text-sm sm:text-base font-medium text-gray-200 mb-2 drop-shadow-sm max-w-xl">
                Ajukan permohonan surat administrasi kependudukan Anda secara online dengan cepat, praktis, dan transparan.
            </p>
        </div>
    </div>

    <!-- Jalur Statistik / Informasi Ringkas -->
    <div class="relative z-10 w-full bg-slate-100 py-3 text-center border-t border-gray-200">
        <p class="text-[11px] sm:text-xs text-slate-500 font-medium">
            • Silakan pilih jenis layanan surat di bawah ini untuk memulai pengajuan •
        </p>
    </div>
</div>

<!-- ========================================== -->
<!-- MAIN WRAPPER SECTION (Bg: Slate-50)       -->
<!-- ========================================== -->
<div class="bg-slate-50 w-full py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        <!-- Grid Menu Layanan Digital -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-aos="fade-up">
            
            <!-- Kartu 1: SKTM -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-xs p-6 flex flex-col justify-between h-[360px] transform hover:-translate-y-2 hover:shadow-md transition-all duration-300">
                <div class="space-y-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-900 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                        🏥
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-xl font-black text-slate-900 leading-snug">Surat Keterangan Tidak Mampu (SKTM)</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Digunakan untuk keperluan keringanan biaya pengobatan medis, pengajuan syarat beasiswa pendidikan, atau permohonan bantuan sosial dari pemerintah.
                        </p>
                    </div>
                </div>
                
                <button onclick="openModal('Surat Keterangan Tidak Mampu')" class="w-full bg-[#1A365D] hover:bg-[#22457a] text-white text-xs font-bold py-3 px-4 rounded-xl shadow-sm transition duration-300 text-center">
                    Ajukan Permohonan
                </button>
            </div>

            <!-- Kartu 2: SKD -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-xs p-6 flex flex-col justify-between h-[360px] transform hover:-translate-y-2 hover:shadow-md transition-all duration-300">
                <div class="space-y-4">
                    <div class="w-12 h-12 bg-amber-50 text-amber-700 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                        📍
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-xl font-black text-slate-900 leading-snug">Surat Keterangan Domisili</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Digunakan sebagai surat bukti resmi domisili atau tempat tinggal terkini untuk keperluan syarat melamar pekerjaan, administrasi perbankan, maupun urusan legalitas lainnya.
                        </p>
                    </div>
                </div>
                
                <button onclick="openModal('Surat Keterangan Domisili')" class="w-full bg-[#1A365D] hover:bg-[#22457a] text-white text-xs font-bold py-3 px-4 rounded-xl shadow-sm transition duration-300 text-center">
                    Ajukan Permohonan
                </button>
            </div>

            <!-- Kartu 3: Dokumen Kependudukan -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-xs p-6 flex flex-col justify-between h-[360px] transform hover:-translate-y-2 hover:shadow-md transition-all duration-300">
                <div class="space-y-4">
                    <div class="w-12 h-12 bg-purple-50 text-purple-700 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                        🗂️
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-xl font-black text-slate-900 leading-snug">Pengantar Dokumen Kependudukan</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Surat pengantar resmi dari desa untuk pengurusan atau pembuatan berkas e-KTP baru, pembaharuan Kartu Keluarga (KK), Akta Kelahiran, maupun Surat Keterangan Pindah.
                        </p>
                    </div>
                </div>
                
                <button onclick="openModal('Dokumen Kependudukan')" class="w-full bg-[#1A365D] hover:bg-[#22457a] text-white text-xs font-bold py-3 px-4 rounded-xl shadow-sm transition duration-300 text-center">
                    Ajukan Permohonan
                </button>
            </div>

            <!-- Kartu 4: Surat Keterangan Usaha (SKU) -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-xs p-6 flex flex-col justify-between h-[360px] transform hover:-translate-y-2 hover:shadow-md transition-all duration-300">
                <div class="space-y-4">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-700 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                        🏪
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-xl font-black text-slate-900 leading-snug">Surat Keterangan Usaha (SKU)</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Diperuntukkan bagi para pelaku UMKM desa sebagai syarat legalitas penunjang permohonan pembiayaan modal, pembuatan badan usaha, atau pengajuan kredit perbankan KUR.
                        </p>
                    </div>
                </div>
                
                <button onclick="openModal('Surat Keterangan Usaha (SKU)')" class="w-full bg-[#1A365D] hover:bg-[#22457a] text-white text-xs font-bold py-3 px-4 rounded-xl shadow-sm transition duration-300 text-center">
                    Ajukan Permohonan
                </button>
            </div>

            <!-- Kartu 5: Surat Keterangan Bersih Diri -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-xs p-6 flex flex-col justify-between h-[360px] transform hover:-translate-y-2 hover:shadow-md transition-all duration-300">
                <div class="space-y-4">
                    <div class="w-12 h-12 bg-rose-50 text-rose-700 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                        📜
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-xl font-black text-slate-900 leading-snug">Surat Keterangan Kelakuan Baik</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Surat keterangan pengantar kelakuan baik yang diterbitkan oleh pemerintah desa guna melengkapi prasyarat pendaftaran institusi, melamar pekerjaan, atau pembuatan SKCK.
                        </p>
                    </div>
                </div>
                
                <button onclick="openModal('Surat Keterangan Kelakuan Baik')" class="w-full bg-[#1A365D] hover:bg-[#22457a] text-white text-xs font-bold py-3 px-4 rounded-xl shadow-sm transition duration-300 text-center">
                    Ajukan Permohonan
                </button>
            </div>

            <!-- Kartu 6: Layanan Pengaduan -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-xs p-6 flex flex-col justify-between h-[360px] transform hover:-translate-y-2 hover:shadow-md transition-all duration-300">
                <div class="space-y-4">
                    <div class="w-12 h-12 bg-indigo-50 text-indigo-700 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                        📣
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-xl font-black text-slate-900 leading-snug">Layanan Aspirasi & Pengaduan</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Wadah penyampaian aspirasi, saran pembangunan, ataupun laporan terkait fasilitas umum dan kendala kedinasan langsung kepada perangkat Pemerintah Desa Parengan.
                        </p>
                    </div>
                </div>
                
                <button onclick="openModal('Layanan Aspirasi & Pengaduan')" class="w-full bg-[#1A365D] hover:bg-[#22457a] text-white text-xs font-bold py-3 px-4 rounded-xl shadow-sm transition duration-300 text-center">
                    Kirim Pengaduan
                </button>
            </div>

        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- MODAL OVERLAY SECTION                      -->
<!-- ========================================== -->
<div id="modalLayanan" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-6 transition-all duration-300">
    <!-- Backdrop Blur -->
    <div onclick="closeModal()" class="absolute inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity duration-300 opacity-0" id="modalBackdrop"></div>

    <!-- Modal Box Container -->
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 w-full max-w-lg overflow-hidden relative z-10 transform transition-all duration-300 scale-95 opacity-0" id="modalBox">
        
        <!-- Header Modal -->
        <div class="bg-[#1A365D] text-white px-6 py-5 flex items-center justify-between">
            <div>
                <span class="text-[10px] font-extrabold uppercase tracking-widest text-amber-400 bg-black/20 px-2 py-0.5 rounded-md">Pengajuan Online</span>
                <h2 id="modalTitle" class="text-lg font-black leading-tight mt-1">Formulir Layanan</h2>
            </div>
            <button onclick="closeModal()" class="text-slate-300 hover:text-white p-1 rounded-lg hover:bg-white/10 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Formulir Input -->
        <form action="#" method="POST" class="p-6 space-y-4 max-h-[70vh] overflow-y-auto bg-white">
            @csrf
            <input type="hidden" id="inputJenisSurat" name="jenis_surat">

            <div class="space-y-1">
                <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">Nama Lengkap</label>
                <input type="text" name="nama" required placeholder="Masukkan nama sesuai KTP" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-blue-900 focus:ring-1 focus:ring-blue-900 text-xs outline-none bg-slate-50/50 transition">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">NIK (No. KTP)</label>
                    <input type="number" name="nik" required placeholder="16 digit nomor NIK" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-blue-900 focus:ring-1 focus:ring-blue-900 text-xs outline-none bg-slate-50/50 transition [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                </div>
                <div class="space-y-1">
                    <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">No. WhatsApp / HP</label>
                    <input type="tel" name="telepon" required placeholder="Contoh: 081234..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-blue-900 focus:ring-1 focus:ring-blue-900 text-xs outline-none bg-slate-50/50 transition">
                </div>
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">Keperluan Pengajuan</label>
                <textarea name="keperluan" rows="3" required placeholder="Jelaskan alasan atau tujuan pengajuan secara rinci..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-blue-900 focus:ring-1 focus:ring-blue-900 text-xs outline-none bg-slate-50/50 transition resize-none"></textarea>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeModal()" class="w-1/3 px-4 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold tracking-wide transition">
                    Batal
                </button>
                <button type="submit" class="w-2/3 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold tracking-wide transition shadow-xs text-center">
                    Kirim Permohonan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(jenisLayanan) {
        const modal = document.getElementById('modalLayanan');
        const modalBox = document.getElementById('modalBox');
        const backdrop = document.getElementById('modalBackdrop');
        
        document.getElementById('modalTitle').innerText = jenisLayanan;
        document.getElementById('inputJenisSurat').value = jenisLayanan;

        modal.classList.remove('hidden');
        
        // Memicu efek transisi CSS
        setTimeout(() => {
            backdrop.classList.remove('opacity-0');
            backdrop.classList.add('opacity-100');
            
            modalBox.classList.remove('scale-95', 'opacity-0');
            modalBox.classList.add('scale-100', 'opacity-100');
        }, 20);
    }

    function closeModal() {
        const modal = document.getElementById('modalLayanan');
        const modalBox = document.getElementById('modalBox');
        const backdrop = document.getElementById('modalBackdrop');

        modalBox.classList.remove('scale-100', 'opacity-100');
        modalBox.classList.add('scale-95', 'opacity-0');
        
        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>
@endsection