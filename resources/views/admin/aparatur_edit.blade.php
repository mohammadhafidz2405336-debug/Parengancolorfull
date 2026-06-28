@extends('layouts.admin')

@section('title', 'Edit Perangkat Desa')
@section('page_title', 'Aparatur Desa')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Edit Pemangku Jabatan: {{ $perangkat->jabatan }}</h2>
            <p class="text-xs text-slate-500">Perbarui identitas pejabat resmi desa sesuai dengan struktur organisasi terbaru.</p>
        </div>
        <a href="{{ route('admin.aparatur.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-600 text-xs font-bold transition shadow-sm">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="max-w-3xl bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <form action="{{ route('admin.aparatur.update', $perangkat->id) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                <!-- Sisi Kiri: Foto -->
                <div class="flex flex-col items-center p-4 border border-dashed border-slate-200 rounded-2xl bg-slate-50/50">
                    <label class="text-xs font-bold text-slate-500 mb-3 uppercase tracking-wider">Foto Profil</label>
                    <div class="relative w-32 h-40 rounded-xl bg-slate-100 border border-slate-200 shadow-inner overflow-hidden flex items-center justify-center mb-4">
                        @if($perangkat->foto)
                            <img id="image-preview" src="{{ asset('storage/' . $perangkat->foto) }}" class="w-full h-full object-cover">
                        @else
                            <img id="image-preview" class="w-full h-full object-cover hidden">
                            <i id="placeholder-icon" class="fa-solid fa-user-tie text-4xl text-slate-300"></i>
                        @endif
                    </div>
                    <label class="px-4 py-2 bg-white border border-slate-200 rounded-lg shadow-sm text-xs font-bold text-slate-600 cursor-pointer hover:bg-slate-50 transition">
                        Pilih File Foto
                        <input type="file" id="foto" name="foto" class="hidden" accept="image/*">
                    </label>
                </div>

                <!-- Sisi Kanan: Input Data -->
                <div class="md:col-span-2 space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Nama Lengkap Perangkat</label>
                        <input type="text" name="nama" value="{{ $perangkat->nama == 'Belum Diatur' ? '' : $perangkat->nama }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-900/10 focus:border-blue-900 transition" placeholder="Masukkan nama beserta gelar pemangku jabatan" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Email Resmi</label>
                        <input type="email" name="email" value="{{ $perangkat->email ?? '' }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-900/10 focus:border-blue-900 transition" placeholder="Contoh: kades@parengan.desa.id">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Jam Pelayanan Kantor</label>
                        <input type="text" name="jam_pelayanan" value="{{ $perangkat->jam_pelayanan ?? '' }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-900/10 focus:border-blue-900 transition" placeholder="Contoh: 08:00 - 15:00 WIB">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Tugas Pokok & Fungsi (Tupoksi)</label>
                        <textarea name="tupoksi" rows="4" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-900/10 focus:border-blue-900 transition resizable-none" placeholder="Masukkan deskripsi tugas pokok dan fungsi jabatan...">{{ $perangkat->tupoksi ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#1A365D] hover:bg-blue-950 text-white rounded-xl text-xs font-bold shadow-md shadow-blue-900/10 hover:shadow-lg transition">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('foto').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.addEventListener('load', function() {
                    const preview = document.getElementById('image-preview');
                    preview.setAttribute('src', this.result);
                    preview.classList.remove('hidden');
                    if(document.getElementById('placeholder-icon')) {
                        document.getElementById('placeholder-icon').classList.add('hidden');
                    }
                });
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection