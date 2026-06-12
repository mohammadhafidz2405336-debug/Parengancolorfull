@extends('layouts.app')

@section('title', 'Pelayanan Digital')

@section('content')
<div class="max-w-7xl mx-auto px-4 pt-4">
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl text-xs font-bold">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-2xl text-xs font-bold">
            {{ $errors->first() }}
        </div>
    @endif
</div>
<div class="w-full min-h-[40vh] bg-cover bg-center relative flex flex-col justify-between" 
     style="background-image: url('{{ asset('images/bg-parengan.jpg') }}');">
    <div class="absolute inset-0 bg-black/50 z-0"></div>

    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 flex-grow">
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

    <div class="relative z-10 w-full bg-slate-100 py-3 text-center border-t border-gray-200">
        <p class="text-[11px] sm:text-xs text-slate-500 font-medium">
            • Silakan pilih jenis layanan surat di bawah ini untuk memulai pengajuan •
        </p>
    </div>
</div>

<div class="bg-slate-50 w-full py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($listSurat as $surat)
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 mb-2">{{ $surat->nama_surat }}</h3>
                        <p class="text-sm text-slate-500 mb-4">Layanan pengajuan {{ $surat->nama_surat }} secara online untuk warga desa.</p>
                    </div>
                    
                    <button onclick="openModal({{ $surat->id }}, '{{ $surat->nama_surat }}')" 
                            class="w-full bg-[#1A365D] hover:bg-blue-900 text-white text-sm font-semibold py-2.5 px-4 rounded-xl transition text-center">
                        Ajukan Permohonan
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div id="modalLayanan" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-6 transition-all duration-300">
    <div onclick="closeModal()" class="absolute inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity duration-300 opacity-0" id="modalBackdrop"></div>

    <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 w-full max-w-lg overflow-hidden relative z-10 transform transition-all duration-300 scale-95 opacity-0" id="modalBox">
        
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

        <form action="{{ route('surat.kirim') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 max-h-[70vh] overflow-y-auto bg-white">
            @csrf
            <input type="hidden" id="inputJenisSurat" name="jenis_surat_id">

            <div class="space-y-1">
                <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">Nama Lengkap</label>
                <input type="text" name="nama" required placeholder="Masukkan nama sesuai KTP" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-blue-900 focus:ring-1 focus:ring-blue-900 text-xs text-slate-900 font-medium outline-none bg-slate-50/50 transition">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">NIK (No. KTP)</label>
                    <input type="number" name="nik" required placeholder="16 digit nomor NIK" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-blue-900 focus:ring-1 focus:ring-blue-900 text-xs text-slate-900 font-medium outline-none bg-slate-50/50 transition [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                </div>
                <div class="space-y-1">
                    <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">No. WhatsApp / HP</label>
                    <input type="tel" name="telepon" required placeholder="Contoh: 081234..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-blue-900 focus:ring-1 focus:ring-blue-900 text-xs text-slate-900 font-medium outline-none bg-slate-50/50 transition">
                </div>
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">Keperluan Pengajuan</label>
                <textarea name="keperluan" rows="3" required placeholder="Jelaskan alasan atau tujuan pengajuan secara rinci..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-blue-900 focus:ring-1 focus:ring-blue-900 text-xs text-slate-900 font-medium outline-none bg-slate-50/50 transition resize-none"></textarea>
            </div>

            <div id="formSyaratDinamis" class="space-y-4 pt-2 border-t border-dashed border-slate-100">
                </div>

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
    function openModal(idJenisSurat, jenisLayanan) {
        const modal = document.getElementById('modalLayanan');
        const modalBox = document.getElementById('modalBox');
        const backdrop = document.getElementById('modalBackdrop');
        
        document.getElementById('modalTitle').innerText = jenisLayanan;
        document.getElementById('inputJenisSurat').value = idJenisSurat; 

        const wadahDinamis = document.getElementById('formSyaratDinamis');
        wadahDinamis.innerHTML = ''; // Reset input lama

        let kolomTambahan = [];
        const namaSuratLower = jenisLayanan.toLowerCase();

        // 💡 PEMETAAN BARU: Menggunakan tipe data (text, date, file)
        if (namaSuratLower.includes('nikah')) {
            kolomTambahan = [
                { nama: 'Nama Pasangan', type: 'text' },
                { nama: 'Tempat Pernikahan', type: 'text' },
                { nama: 'Tanggal Pernikahan', type: 'date' },
                { nama: 'Agama Pasangan', type: 'text' }
            ];
        } 
        else if (namaSuratLower.includes('kartu keluarga') || namaSuratLower.includes('kk')) {
            kolomTambahan = [
                { nama: 'Alasan Pengajuan', type: 'text' },
                { nama: 'Alamat Lengkap KK', type: 'text' },
                { nama: 'Scan / Foto KK Lama', type: 'file' }
            ];
        } 
        else if (namaSuratLower.includes('akta lahir')) {
            kolomTambahan = [
                { nama: 'Nama Anak', type: 'text' },
                { nama: 'Tempat Lahir Anak', type: 'text' },
                { nama: 'Tanggal Lahir Anak', type: 'date' },
                { nama: 'Nama Ayah', type: 'text' },
                { nama: 'Nama Ibu', type: 'text' }
            ];
        } 
        else if (namaSuratLower.includes('kia')) {
            kolomTambahan = [
                { nama: 'Nama Anak', type: 'text' },
                { nama: 'NIK Anak', type: 'text' },
                { nama: 'Tanggal Lahir Anak', type: 'date' },
                { nama: 'Foto Anak (Jika ada)', type: 'file' }
            ];
        } 
        else if (namaSuratLower.includes('ktp')) {
            kolomTambahan = [
                { nama: 'Alasan Pembuatan', type: 'text' },
                { nama: 'Golongan Darah', type: 'text' },
                { nama: 'Status Perkawinan', type: 'text' },
                { nama: 'Scan / Foto KK Pemohon', type: 'file' }
            ];
        } 
        else if (namaSuratLower.includes('domisili')) {
            kolomTambahan = [
                { nama: 'Jenis Kelamin', type: 'text' },
                { nama: 'Tempat Lahir', type: 'text' },
                { nama: 'Tanggal Lahir', type: 'date' },
                { nama: 'Kewarganegaraan', type: 'text' },
                { nama: 'Agama', type: 'text' },
                { nama: 'Alamat Asal', type: 'text' }
            ];
        } 
        else if (namaSuratLower.includes('sktm')) {
            kolomTambahan = [
                { nama: 'Pekerjaan', type: 'text' },
                { nama: 'Penghasilan Bulanan', type: 'text' },
                { nama: 'Jumlah Tanggungan Orang Tua', type: 'text' },
                { nama: 'Foto Rumah Depan', type: 'file' }
            ];
        }

        // Cetak Elemen ke dalam Form Modal secara Otomatis
        if (kolomTambahan.length > 0) {
            wadahDinamis.classList.remove('hidden');
            wadahDinamis.innerHTML = `<div class="text-[10px] font-bold text-blue-900 tracking-wider uppercase mb-1">📋 Informasi Data & Berkas Syarat</div>`;
            
            kolomTambahan.forEach(item => {
                let inputElement = '';

                if (item.type === 'file') {
                    // Desain Khusus Input File/Upload Gambar agar rapi pakai Tailwind
                    inputElement = `
                        <input type="file" 
                               name="tambahan_file[${item.nama}]" 
                               required 
                               accept="image/*,application/pdf"
                               class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-700 bg-slate-50/50 file:mr-4 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-[#1A365D] hover:file:bg-blue-100 transition outline-none">
                    `;
                } else if (item.type === 'date') {
                    // Desain Input Tanggal (Date Picker bawaan browser)
                    inputElement = `
                        <input type="date" 
                               name="tambahan[${item.nama}]" 
                               required 
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-blue-900 focus:ring-1 focus:ring-blue-900 text-xs text-slate-900 font-medium outline-none bg-slate-50/50 transition">
                    `;
                } else {
                    // Input Teks Biasa
                    inputElement = `
                        <input type="text" 
                               name="tambahan[${item.nama}]" 
                               required 
                               placeholder="Masukkan ${item.nama.toLowerCase()}..." 
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-blue-900 focus:ring-1 focus:ring-blue-900 text-xs text-slate-900 font-medium outline-none bg-slate-50/50 transition">
                    `;
                }

                const susunanHTML = `
                    <div class="space-y-1">
                        <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">${item.nama}</label>
                        ${inputElement}
                    </div>
                `;
                wadahDinamis.insertAdjacentHTML('beforeend', susunanHTML);
            });
        } else {
            wadahDinamis.classList.add('hidden');
        }

        modal.classList.remove('hidden');
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