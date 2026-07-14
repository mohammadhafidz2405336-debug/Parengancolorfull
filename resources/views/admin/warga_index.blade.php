@extends('layouts.admin')
@section('title', 'Data Warga')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Master Data Warga</h2>
            <p class="text-sm text-slate-500">Kelola data seluruh penduduk desa.</p>
        </div>
        
        <div class="flex gap-2">
            <form action="{{ route('admin.warga.index') }}" method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/NIK..." 
                       class="border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                <button type="submit" class="bg-slate-700 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-slate-800">
                    Cari
                </button>
            </form>

            <!-- Tombol Tambah Warga Manual -->
            <button type="button" onclick="document.getElementById('tambahModal').classList.remove('hidden'); document.getElementById('tambahModal').classList.add('flex');" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition-colors">
                <i class="fa-solid fa-plus"></i> Tambah Warga
            </button>

            <a href="{{ asset('templates/template_warga.xlsx') }}" class="bg-slate-600 hover:bg-slate-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2">
                <i class="fa-solid fa-download"></i> Template
            </a>
            
            <form action="{{ route('admin.warga.import') }}" method="POST" enctype="multipart/form-data" class="flex gap-2 items-center">
                @csrf
                <input type="file" name="file" required 
                    class="block w-full text-sm text-slate-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-lg file:border-0
                            file:text-sm file:font-semibold
                            file:bg-amber-400 file:text-white
                            hover:file:bg-amber-500 hover:file:cursor-pointer transition-all">
                
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                    <i class="fa-solid fa-file-excel"></i> Import
                </button>
            </form>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Alert Error -->
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ session('error') }}
        </div>
    @endif
    
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 text-sm">
            <ul class="list-disc pl-4 text-left">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 text-sm">
                    <th class="p-4 font-semibold">No</th>
                    <th class="p-4 font-semibold">NIK</th>
                    <th class="p-4 font-semibold">Nama Lengkap</th>
                    <th class="p-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-slate-100">
                @forelse($warga as $key => $item)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="p-4 text-slate-500">{{ $warga->firstItem() + $key }}</td>
                    <td class="p-4 font-medium text-slate-700">{{ $item->nik_sensor }}</td>
                    <td class="p-4">{{ $item->nama }}</td>
                    <td class="p-4 text-center">
                        <button onclick="showDetail('{{ route('admin.warga.detail', $item->id) }}')" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition-colors">
                            Lihat Detail
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-8 text-center text-slate-400 font-medium">Data tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $warga->links() }}
    </div>
</div>

<!-- Modal Detail Warga -->
<div id="detailModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded-xl w-96 shadow-xl">
        <h3 class="text-lg font-bold mb-4 text-slate-800">Detail Warga</h3>
        <div id="modalContent" class="space-y-3 text-sm text-slate-600">
            <p class="text-center">Memuat data...</p>
        </div>
        <button onclick="document.getElementById('detailModal').classList.add('hidden'); document.getElementById('detailModal').classList.remove('flex');" 
                class="mt-6 w-full bg-slate-800 hover:bg-slate-900 text-white py-2 rounded-lg transition-colors">
            Tutup
        </button>
    </div>
</div>

<!-- Modal Tambah Data Warga -->
<div id="tambahModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded-xl w-full max-w-md shadow-xl">
        <h3 class="text-lg font-bold mb-4 text-slate-800">Tambah Data Warga</h3>
        
        <form action="{{ route('admin.warga.store') }}" method="POST">
            @csrf
            <div class="space-y-4 text-left">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">NIK (16 Digit)</label>
                    <input type="number" name="nik" required minlength="16" maxlength="16" value="{{ old('nik') }}"
                           class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none" 
                           placeholder="Masukkan 16 digit NIK">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" required value="{{ old('nama') }}"
                           class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none" 
                           placeholder="Nama Lengkap">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">RT</label>
                        <input type="number" name="rt" required value="{{ old('rt') }}"
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none" 
                               placeholder="Contoh: 01">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">RW</label>
                        <input type="number" name="rw" required value="{{ old('rw') }}"
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none" 
                               placeholder="Contoh: 02">
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex justify-end gap-2">
                <button type="button" 
                        onclick="document.getElementById('tambahModal').classList.add('hidden'); document.getElementById('tambahModal').classList.remove('flex');" 
                        class="bg-slate-200 hover:bg-slate-300 text-slate-800 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    Batal
                </button>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showDetail(url) {
    const modal = document.getElementById('detailModal');
    const content = document.getElementById('modalContent');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    content.innerHTML = '<p class="text-center">Memuat data...</p>'; // Reset loading
    
    fetch(url)
        .then(response => response.json())
        .then(data => {
            content.innerHTML = `
                <p><strong>Nama:</strong> ${data.nama}</p>
                <p><strong>NIK Asli:</strong> ${data.nik_asli}</p>
                <p><strong>Alamat:</strong> RT ${data.rt} / RW ${data.rw}</p>
                <p><strong>Terdaftar:</strong> ${data.created_at}</p>
            `;
        })
        .catch(error => {
            content.innerHTML = '<p class="text-center text-red-500">Gagal memuat data.</p>';
        });
}
</script>
@endsection