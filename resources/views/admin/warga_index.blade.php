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

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
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

<div id="detailModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded-xl w-96 shadow-xl">
        <h3 class="text-lg font-bold mb-4 text-slate-800">Detail Warga</h3>
        <div id="modalContent" class="space-y-3 text-sm text-slate-600">
            <p class="text-center">Memuat data...</p>
        </div>
        <button onclick="document.getElementById('detailModal').classList.add('hidden')" 
                class="mt-6 w-full bg-slate-800 hover:bg-slate-900 text-white py-2 rounded-lg transition-colors">
            Tutup
        </button>
    </div>
</div>

<script>
function showDetail(url) {
    const modal = document.getElementById('detailModal');
    const content = document.getElementById('modalContent');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    fetch(url)
        .then(response => response.json())
        .then(data => {
            content.innerHTML = `
                <p><strong>Nama:</strong> ${data.nama}</p>
                <p><strong>NIK Asli:</strong> ${data.nik_asli}</p>
                <p><strong>Alamat:</strong> RT ${data.rt} / RW ${data.rw}</p>
                <p><strong>Terdaftar:</strong> ${data.created_at}</p>
            `;
        });
}
</script>
@endsection