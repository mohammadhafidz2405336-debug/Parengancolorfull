@extends('layouts.admin')

@section('title', 'Tambah Berita Baru')
@section('page_title', 'Tambah Berita')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.berita.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-500 hover:text-[#1A365D] transition mb-2">
            <i class="fa-solid fa-arrow-left-long"></i> Kembali ke Daftar Berita
        </a>
        <h2 class="text-xl font-bold text-slate-900">Buat Artikel Berita Baru</h2>
        <p class="text-xs text-slate-500">Tulis informasi atau pengumuman terkini untuk disebarluaskan di platform berita desa.</p>
    </div>

    <div class="max-w-4xl">
        <form action="#" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 space-y-6">
            @csrf 
            
            <div>
                <label for="judul" class="block text-xs font-bold uppercase text-slate-500 tracking-wider mb-2">Judul Berita</label>
                <input type="text" id="judul" name="judul" required placeholder="Contoh: Kegiatan Rembuk Stunting Tingkat Desa Tahun 2026" 
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-[#1A365D] focus:ring-2 focus:ring-blue-100 outline-none text-sm font-medium transition placeholder:text-slate-400">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="kategori" class="block text-xs font-bold uppercase text-slate-500 tracking-wider mb-2">Kategori Konten</label>
                    <select id="kategori" name="kategori" required 
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-[#1A365D] outline-none text-sm font-medium transition">
                        <option value="" disabled selected>-- Pilih Kategori Berita --</option>
                        <option value="Kesehatan">Kesehatan</option>
                        <option value="Lingkungan">Lingkungan / Alam</option>
                        <option value="Pendidikan">Pendidikan & Kebudayaan</option>
                        <option value="Pemerintahan">Pengumuman Pemerintah Desa</option>
                        <option value="Kegiatan">Kegiatan Masyarakat</option>
                    </select>
                </div>

                <div>
                    <label for="penulis" class="block text-xs font-bold uppercase text-slate-500 tracking-wider mb-2">Penulis / Sumber Konten</label>
                    <input type="text" id="penulis" name="penulis" required placeholder="Contoh: Pemerintah Desa / Karang Taruna" 
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-[#1A365D] outline-none text-sm font-medium transition placeholder:text-slate-400">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 tracking-wider mb-2">Gambar Sampul Berita (Thumbnail)</label>
                <div class="border-2 border-dashed border-slate-200 hover:border-[#1A365D] bg-slate-50/50 rounded-2xl p-6 transition flex flex-col items-center justify-center text-center group cursor-pointer relative">
                    <input type="file" id="gambar" name="gambar" accept="image/*" required class="absolute inset-0 opacity-0 cursor-pointer">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-[#1A365D] flex items-center justify-center text-lg mb-3 group-hover:scale-110 transition duration-300">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                    </div>
                    <p id="file-label-text" class="text-sm font-bold text-slate-700 mb-0.5">Pilih file gambar atau seret ke sini</p>
                    <span class="text-xs text-slate-400 font-medium">Format yang didukung: JPG, JPEG, PNG (Maks. 2MB)</span>
                </div>
            </div>

            <div>
                <label for="isi_berita" class="block text-xs font-bold uppercase text-slate-500 tracking-wider mb-2">Isi Lengkap Artikel Berita</label>
                <textarea id="isi_berita" name="isi_berita" rows="8" required placeholder="Tuliskan berita secara mendalam di sini..." 
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-[#1A365D] focus:ring-2 focus:ring-blue-100 outline-none text-sm font-medium transition placeholder:text-slate-400 leading-relaxed"></textarea>
            </div>

            <div class="border-t border-slate-100 pt-6 flex items-center justify-end gap-3">
                <a href="{{ route('admin.berita.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-600 text-xs font-bold transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#1A365D] hover:bg-blue-950 text-white text-xs font-bold shadow-md transition">
                    <i class="fa-solid fa-paper-plane mr-1.5"></i> Publikasikan Berita
                </button>
            </div>

        </form>
    </div>

    <script>
        document.getElementById('gambar').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : "Pilih file gambar atau seret ke sini";
            document.getElementById('file-label-text').innerText = fileName;
        });
    </script>
@endsection