@extends('layouts.admin')

@section('title', 'Kelola Permohonan Surat')
@section('page_title', 'Pelayanan Surat')

@section('content')
    <div class="mb-6">
        <h2 class="text-xl font-bold text-slate-900">Manajemen Permohonan Surat Warga</h2>
        <p class="text-xs text-slate-500">Pantau, verifikasi, dan ubah status pengajuan surat online yang dikirimkan oleh warga secara real-time.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-4 mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="relative w-full sm:w-72">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400 text-xs">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" placeholder="Cari nama pemohon atau NIK..." 
                class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-[#1A365D] focus:ring-2 focus:ring-blue-100 outline-none text-xs font-medium transition">
        </div>
        
        <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
            <select class="px-3 py-2 rounded-xl border border-slate-200 bg-slate-50 text-xs font-semibold text-slate-600 outline-none focus:bg-white focus:border-[#1A365D]">
                <option value="">Semua Status</option>
                <option value="pending">⏳ Pending</option>
                <option value="proses">⚙ Proses</option>
                <option value="selesai">✅ Selesai</option>
                <option value="ditolak">❌ Ditolak</option>
            </select>
            <select class="px-3 py-2 rounded-xl border border-slate-200 bg-slate-50 text-xs font-semibold text-slate-600 outline-none focus:bg-white focus:border-[#1A365D]">
                <option value="">Semua Jenis Surat</option>
                <option value="sktm">Surat Ket. Tidak Mampu</option>
                <option value="skd">Surat Ket. Domisili</option>
                <option value="sku">Surat Ket. Usaha</option>
            </select>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-400 text-[11px] font-bold tracking-wider uppercase">
                        <th class="py-4 px-6 w-12 text-center">No</th>
                        <th class="py-4 px-6">Warga / Pemohon</th>
                        <th class="py-4 px-6">Jenis Layanan Surat</th>
                        <th class="py-4 px-6">Kontak / Keperluan</th>
                        <th class="py-4 px-6">Tgl Masuk</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
                    
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-4 px-6 text-center text-slate-400">1</td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-slate-900 text-sm">Ahmad Fauzi</div>
                            <div class="text-[10px] text-slate-400 font-normal mt-0.5">NIK: 3524XXXXXXXX0003</div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-block px-2 py-1 rounded-lg bg-blue-50 text-blue-800 font-semibold text-[11px]">
                                Surat Keterangan Tidak Mampu (SKTM)
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="text-slate-800 line-clamp-1">Syarat Pengajuan Beasiswa Kuliah</div>
                            <div class="text-[10px] text-emerald-600 font-semibold mt-0.5"><i class="fa-brands fa-whatsapp"></i> 081234567890</div>
                        </td>
                        <td class="py-4 px-6 text-slate-500 font-normal">06 Juni 2026</td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-block px-2 py-0.5 rounded-full bg-amber-50 border border-amber-200 text-amber-600 font-bold text-[10px] uppercase">⏳ Pending</span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center gap-1.5">
                                <button onclick="openVerifikasiModal('Ahmad Fauzi', 'Surat Keterangan Tidak Mampu (SKTM)', 'Syarat Pengajuan Beasiswa Kuliah', 'pending')" 
                                    class="px-2.5 py-1.5 rounded-lg bg-[#1A365D] text-white hover:bg-blue-950 flex items-center gap-1 font-bold text-[11px] transition">
                                    <i class="fa-solid fa-file-shield"></i> Verifikasi
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-4 px-6 text-center text-slate-400">2</td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-slate-900 text-sm">Siti Aminah</div>
                            <div class="text-[10px] text-slate-400 font-normal mt-0.5">NIK: 3524XXXXXXXX0001</div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-block px-2 py-1 rounded-lg bg-purple-50 text-purple-800 font-semibold text-[11px]">
                                Surat Keterangan Domisili
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="text-slate-800 line-clamp-1">Pembukaan Rekening Bank Jago</div>
                            <div class="text-[10px] text-emerald-600 font-semibold mt-0.5"><i class="fa-brands fa-whatsapp"></i> 085788889999</div>
                        </td>
                        <td class="py-4 px-6 text-slate-500 font-normal">04 Juni 2026</td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-block px-2 py-0.5 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-600 font-bold text-[10px] uppercase">✅ Selesai</span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center gap-1.5">
                                <button onclick="openVerifikasiModal('Siti Aminah', 'Surat Keterangan Domisili', 'Pembukaan Rekening Bank Jago', 'selesai', 'Surat sudah selesai dicetak dan dapat diambil di Balai Desa.')" 
                                    class="px-2.5 py-1.5 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200 flex items-center gap-1 font-bold text-[11px] transition">
                                    <i class="fa-solid fa-eye"></i> Detail
                                </button>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <div id="modalVerifikasi" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div id="modalBackdrop" class="absolute inset-0 bg-black/40 backdrop-blur-xs opacity-0 transition-opacity duration-300"></div>
        <div id="modalBox" class="relative bg-white rounded-2xl border border-slate-200 shadow-2xl w-full max-w-lg p-6 m-4 transform scale-95 opacity-0 transition-all duration-300">
            <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-file-invoice text-[#1A365D]"></i> Verifikasi Dokumen Permohonan
            </h3>
            
            <div class="space-y-3 mb-6 text-xs text-slate-600">
                <div class="grid grid-cols-3"><span class="font-bold">Nama Pemohon</span><span class="col-span-2 text-slate-900" id="m-nama">: -</span></div>
                <div class="grid grid-cols-3"><span class="font-bold">Jenis Surat</span><span class="col-span-2 text-slate-900 font-semibold" id="m-jenis">: -</span></div>
                <div class="grid grid-cols-3"><span class="font-bold">Keperluan</span><span class="col-span-2 text-slate-800 italic" id="m-keperluan">: -</span></div>
            </div>

            <form action="#" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[10px] font-bold uppercase text-slate-500 tracking-wider mb-1.5">Ubah Status Berkas</label>
                    <select id="m-status-select" name="status" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-slate-50 font-semibold text-xs text-slate-700 outline-none focus:bg-white focus:border-[#1A365D]">
                        <option value="pending">⏳ Pending (Menunggu Verifikasi)</option>
                        <option value="proses">⚙ Proses (Sedang Diketik/Ttd)</option>
                        <option value="selesai">✅ Selesai (Siap Diambil)</option>
                        <option value="ditolak">❌ Ditolak (Berkas Tidak Valid)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase text-slate-500 tracking-wider mb-1.5">Catatan Tambahan Admin (Akan Dilihat Warga)</label>
                    <textarea id="m-catatan" name="keterangan_admin" rows="3" placeholder="Contoh: Surat sudah ditandatangani Kepala Desa, silakan diambil membawa KTP asli." 
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-medium bg-slate-50 focus:bg-white outline-none focus:border-[#1A365D] focus:ring-2 focus:ring-blue-100 transition"></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-100">
                    <button type="button" onclick="closeVerifikasiModal()" class="px-4 py-2 rounded-xl border border-slate-200 text-slate-500 font-bold hover:bg-slate-50 transition">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-[#1A365D] text-white font-bold hover:bg-blue-950 shadow-md transition">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openVerifikasiModal(nama, jenis, keperluan, status, catatan = '') {
            document.getElementById('m-nama').innerText = ': ' + nama;
            document.getElementById('m-jenis').innerText = ': ' + jenis;
            document.getElementById('m-keperluan').innerText = ': ' + keperluan;
            document.getElementById('m-status-select').value = status;
            document.getElementById('m-catatan').value = catatan;

            const modal = document.getElementById('modalVerifikasi');
            const backdrop = document.getElementById('modalBackdrop');
            const box = document.getElementById('modalBox');

            modal.classList.remove('hidden');
            setTimeout(() => {
                backdrop.classList.replace('opacity-0', 'opacity-100');
                box.classList.replace('scale-95', 'scale-100');
                box.classList.replace('opacity-0', 'opacity-100');
            }, 20);
        }

        function closeModal() {
            const backdrop = document.getElementById('modalBackdrop');
            const box = document.getElementById('modalBox');
            
            box.classList.replace('scale-100', 'scale-95');
            box.classList.replace('opacity-100', 'opacity-0');
            backdrop.classList.replace('opacity-100', 'opacity-0');
            
            setTimeout(() => {
                document.getElementById('modalVerifikasi').classList.add('hidden');
            }, 300);
        }
    </script>
@endsection