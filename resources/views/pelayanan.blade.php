@extends('layouts.app')

@section('title', 'Pelayanan Digital')

@section('content')
<div class="w-full bg-[#F0F4F8] text-slate-900 py-12 px-4 sm:px-6 lg:px-8 min-h-screen">
    <div class="w-full max-w-7xl mx-auto bg-white rounded-3xl shadow-md overflow-hidden" data-aos="fade-up">
    
        <div class="bg-[#1A365D] text-white text-center py-6">
            <h1 class="text-2xl sm:text-3xl font-black tracking-wide uppercase">Menu Layanan Digital</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-6 sm:p-8 pb-20 bg-white">
            
            <div class="bg-[#FAFAFA] border border-slate-200/80 p-6 rounded-3xl shadow-sm relative flex flex-col justify-between h-[380px] hover:shadow-md transition duration-300">
                <div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2 leading-snug">Surat Keterangan Tidak Mampu</h3>
                    <p class="text-xm text-slate-600 leading-relaxed line-clamp-4 overflow-hidden">
                        Untuk keperluan pengobatan, syarat beasiswa, atau bantuan pemerintah.
                    </p>
                </div>
                
                <div class="flex justify-center w-full bg-[#1A365D] rounded-3xl py-3">
                    <button onclick="openModal('Surat Keterangan Tidak Mampu')" class="group flex w-full h-full justify-center gap-2 hover:bg-[#22457a] text-white text-xs font-bold px-4 py-3.5 rounded-xl shadow-sm transition duration-300">
                        <span class="whitespace-nowrap justify-center">Detail Layanan</span>
                    </button>
                </div>
            </div>

            <div class="bg-[#FAFAFA] border border-slate-200/80 p-6 rounded-3xl shadow-sm relative flex flex-col justify-between h-[380px] hover:shadow-md transition duration-300">
                <div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2 leading-snug">Surat Keterangan Domisili</h3>
                    <p class="text-xm text-slate-600 leading-relaxed line-clamp-4 overflow-hidden">
                        Untuk keperluan syarat kerja, perbankan, atau urusan lainnya.
                    </p>
                </div>
                
                <div class="flex justify-center w-full bg-[#1A365D] rounded-3xl py-3">
                    <button onclick="openModal('Surat Keterangan Domisili')" class="group flex w-full h-full justify-center gap-2 hover:bg-[#22457a] text-white text-xs font-bold px-4 py-3.5 rounded-xl shadow-sm transition duration-300">
                        <span class="whitespace-nowrap justify-center">Detail Layanan</span>
                    </button>
                </div>
            </div>

            <div class="bg-[#FAFAFA] border border-slate-200/80 p-6 rounded-3xl shadow-sm relative flex flex-col justify-between h-[380px] hover:shadow-md transition duration-300">
                <div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2 leading-snug">Dokumen Kependudukan</h3>
                    <p class="text-xm text-slate-600 leading-relaxed line-clamp-4 overflow-hidden">
                        Surat pengantar untuk pembuatan e-KTP, Kartu Keluarga (KK), Akta Kelahiran, dan Surat Keterangan Pindah.
                    </p>
                </div>
                
                <div class="flex justify-center w-full bg-[#1A365D] rounded-3xl py-3">
                    <button onclick="openModal('Dokumen Kependudukan')" class="group flex w-full h-full justify-center gap-2 hover:bg-[#22457a] text-white text-xs font-bold px-4 py-3.5 rounded-xl shadow-sm transition duration-300">
                        <span class="whitespace-nowrap justify-center">Detail Layanan</span>
                    </button>
                </div>
            </div>

        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-6 sm:p-8 pb-20 bg-white">
            
            <div class="bg-[#FAFAFA] border border-slate-200/80 p-6 rounded-3xl shadow-sm relative flex flex-col justify-between h-[380px] hover:shadow-md transition duration-300">
                <div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2 leading-snug">Surat Keterangan Tidak Mampu</h3>
                    <p class="text-xm text-slate-600 leading-relaxed line-clamp-4 overflow-hidden">
                        Untuk keperluan pengobatan, syarat beasiswa, atau bantuan pemerintah.
                    </p>
                </div>
                
                <div class="flex justify-center w-full bg-[#1A365D] rounded-3xl py-3">
                    <button onclick="openModal('Surat Keterangan Tidak Mampu')" class="group flex flex w-full h-full justify-center gap-2 hover:bg-[#22457a] text-white text-xs font-bold px-4 py-3.5 rounded-xl shadow-sm transition duration-300">
                        <span class="whitespace-nowrap justify-center">Detail Layanan</span>
                    </button>
                </div>
            </div>

            <div class="bg-[#FAFAFA] border border-slate-200/80 p-6 rounded-3xl shadow-sm relative flex flex-col justify-between h-[380px] hover:shadow-md transition duration-300">
                <div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2 leading-snug">Surat Keterangan Domisili</h3>
                    <p class="text-xm text-slate-600 leading-relaxed line-clamp-4 overflow-hidden">
                        Untuk keperluan syarat kerja, perbankan, atau urusan lainnya.
                    </p>
                </div>
                
                <div class="flex justify-center w-full bg-[#1A365D] rounded-3xl py-3">
                    <button onclick="openModal('Surat Keterangan Domisili')" class="group flex w-full h-full justify-center gap-2 hover:bg-[#22457a] text-white text-xs font-bold px-4 py-3.5 rounded-xl shadow-sm transition duration-300">
                        <span class="whitespace-nowrap justify-center">Detail Layanan</span>
                    </button>
                </div>
            </div>

            <div class="bg-[#FAFAFA] border border-slate-200/80 p-6 rounded-3xl shadow-sm relative flex flex-col justify-between h-[380px] hover:shadow-md transition duration-300">
                <div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2 leading-snug">Dokumen Kependudukan</h3>
                    <p class="text-xm text-slate-600 leading-relaxed line-clamp-4 overflow-hidden">
                        Surat pengantar untuk pembuatan e-KTP, Kartu Keluarga (KK), Akta Kelahiran, dan Surat Keterangan Pindah.
                    </p>
                </div>
                
                <div class="flex justify-center w-full bg-[#1A365D] rounded-3xl py-3">
                    <button onclick="openModal('Dokumen Kependudukan')" class="group flex w-full h-full justify-center gap-2 hover:bg-[#22457a] text-white text-xs font-bold px-4 py-3.5 rounded-xl shadow-sm transition duration-300">
                        <span class="whitespace-nowrap justify-center">Detail Layanan</span>
                    </button>
                </div>
            </div>

        </div> 
    </div>
</div>

<div id="modalLayanan" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-6">
    <div onclick="closeModal()" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

    <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 w-full max-w-lg overflow-hidden relative z-10 transform transition duration-300 scale-95" id="modalBox">
        
        <div class="bg-[#1A365D] text-white px-6 py-4 flex items-center justify-between">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-blue-200">Pengajuan Online</span>
                <h2 id="modalTitle" class="text-lg font-black leading-tight">Formulir Layanan</h2>
            </div>
            <button onclick="closeModal()" class="text-blue-100 hover:text-white p-1 rounded-lg hover:bg-white/10 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form action="#" method="POST" class="p-6 space-y-4 max-h-[75vh] overflow-y-auto">
            @csrf
            <input type="hidden" id="inputJenisSurat" name="jenis_surat">

            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-slate-600 mb-1">Nama Lengkap</label>
                <input type="text" name="nama" required placeholder="Masukkan nama sesuai KTP" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 text-sm outline-none bg-slate-50 transition">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-slate-600 mb-1">NIK (No. KTP)</label>
                    <input type="number" name="nik" required placeholder="16 digit nomor NIK" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 text-sm outline-none bg-slate-50 transition">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-slate-600 mb-1">No. WhatsApp / HP</label>
                    <input type="tel" name="telepon" required placeholder="Contoh: 0812345..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 text-sm outline-none bg-slate-50 transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-slate-600 mb-1">Keperluan Pengajuan</label>
                <textarea name="keperluan" rows="3" required placeholder="Jelaskan alasan atau tujuan pengajuan surat ini secara rinci..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 text-sm outline-none bg-slate-50 transition resize-none"></textarea>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeModal()" class="w-1/3 px-4 py-2.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 text-sm font-bold tracking-wide transition">
                    Batal
                </button>
                <button type="submit" class="w-2/3 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold tracking-wide transition shadow-sm">
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
        
        document.getElementById('modalTitle').innerText = jenisLayanan;
        document.getElementById('inputJenisSurat').value = jenisLayanan;

        modal.classList.remove('hidden');
        setTimeout(() => {
            modalBox.classList.remove('scale-95');
            modalBox.classList.add('scale-100');
        }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('modalLayanan');
        const modalBox = document.getElementById('modalBox');

        modalBox.classList.remove('scale-100');
        modalBox.classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 150);
    }
</script>
@endsection