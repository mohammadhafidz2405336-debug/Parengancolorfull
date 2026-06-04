@extends('layouts.app')

{{-- PERBAIKAN: Menggunakan @section agar judul masuk ke <title> dan tidak bocor ke teks halaman --}}
@section('title', 'Profile Desa')

@section('content')
{{-- FORCE BACKGROUND: Menambahkan bg-[#F0F4F8] dan text-slate-900 untuk memaksa halaman ini menjadi mode terang --}}
<div class="w-full bg-[#F0F4F8] text-slate-900 py-12 px-4 sm:px-6 lg:px-8 min-h-screen">
    <div class="max-w-7xl mx-auto">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16" data-aos="fade-up">
            <div class="space-y-6">
                <h1 class="text-3xl font-black tracking-tight text-slate-900 border-b-4 border-amber-500 pb-2 inline-block">
                    Profil Umum Desa Parengan
                </h1>
                <div class="text-slate-700 leading-relaxed text-justify space-y-4 font-normal">
                    <p>
                        Desa Parengan adalah salah satu desa yang terletak di wilayah administratif Kecamatan Maduran, Kab. Lamongan, Provinsi Jawa Timur, Indonesia. Desa ini dikenal dengan karakteristik masyarakatnya yang ramah dan kental dengan nilai-nilai budaya lokal. Selain sektor pertanian dan perkebunan, potensi lain seperti kerajinan tangan, wisata alam, dan UMKM menjadi bagian penting dari perekonomian desa.
                    </p>
                    <p>
                        Kini, Desa Parengan mengambil langkah maju dengan bergabung ke dalam Jaringan Media Desa Nusantara (JMDN). Langkah ini menjadi wujud komitmen desa dalam memanfaatkan teknologi digital untuk mempermudah layanan, meningkatkan kesejahteraan warga, serta memperkenalkan potensi desa ke tingkat yang lebih luas. Melalui JMDN, Desa Parengan siap menjadi bagian dari ekosistem digital yang inklusif, modern, dan berdaya saing.
                    </p>
                </div>
            </div>

            <div class="relative" data-aos="zoom-in" data-aos-delay="200">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-amber-400 rounded-2xl blur opacity-20 transform rotate-1"></div>
                <img src="{{ asset('images/bg-parengan.jpg') }}" alt="Kegiatan Tenun Desa Parengan" class="relative rounded-2xl shadow-xl border border-slate-200 object-cover w-full h-[350px] lg:h-[400px]">
            </div>
        </div>

        <div class="flex justify-center mb-12" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white shadow-sm border border-slate-300 text-sm font-semibold tracking-wide text-slate-700">
                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                Visi & Misi Desa
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20" data-aos="fade-up" data-aos-delay="150">

            <div class="bg-[#FAFAFA] border border-slate-200 shadow-md p-8 rounded-3xl relative overflow-hidden group hover:border-blue-500/50 transition duration-300">
                <div class="absolute top-0 left-0 w-2 h-full bg-blue-600"></div>
                <h2 class="text-2xl font-black text-slate-900 mb-6 flex items-center gap-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Visi
                </h2>
                <p class="text-slate-700 leading-relaxed text-justify font-medium">
                    Terwujudnya Desa Parengan yang Mandiri, Sejahtera, dan Berbudaya melalui Sinergi Ekonomi Kreatif Berbasis Kearifan Lokal dan Tata Kelola Pemerintahan yang Transparan.
                </p>
            </div>

            <div class="bg-[#FAFAFA] border border-slate-200 shadow-md p-8 rounded-3xl relative overflow-hidden group hover:border-amber-500/50 transition duration-300">
                <div class="absolute top-0 left-0 w-2 h-full bg-amber-400"></div>
                <h2 class="text-2xl font-black text-slate-900 mb-6 flex items-center gap-3">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    Misi
                </h2>
                <ul class="space-y-4 text-slate-700 text-sm font-normal">
                    <li class="flex items-start gap-3">
                        <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-amber-500 flex-shrink-0"></span>
                        <span>Mewujudkan tata kelola pemerintahan desa yang bersih, jujur, akuntabel, and transparan dalam pengelolaan anggaran dan administrasi.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-amber-500 flex-shrink-0"></span>
                        <span>Membina dan memberikan fasilitas pelatihan, modal, serta digitalisasi pemasaran bagi para pengrajin, distributor, dan pelaku UMKM lokal di Desa Parengan.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-amber-500 flex-shrink-0"></span>
                        <span>Mengembangkan potensi Desa Wisata Mural sebagai destinasi wisata edukatif-kreatif yang unggul di Kabupaten Lamongan.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-amber-500 flex-shrink-0"></span>
                        <span>Meningkatkan pembangunan infrastruktur desa (jalan, fasilitas umum, dan sarana wisata) yang merata, aman, estetis, dan mendukung kelancaran ekonomi warga.</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="flex justify-center mb-6" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white shadow-sm border border-slate-300 text-sm font-semibold tracking-wide text-slate-700">
                <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                Struktur Organisasi
            </span>
        </div>

        <div class="text-center mb-12" data-aos="fade-up">
            <p class="text-sm text-slate-600">Aparat desa yang bertugas melayani masyarakat desa parengan</p>
        </div>

        <div class="w-full flex flex-col items-center overflow-x-auto pb-8" data-aos="fade-up">
            <div class="min-w-[800px] w-full flex flex-col items-center relative">

                <div class="flex justify-center w-full relative z-10">
                    <div class="bg-[#FAFAFA] border border-slate-200 shadow-md p-4 rounded-xl flex items-center gap-4 w-64">
                        <div class="w-12 h-12 bg-slate-200 rounded-full flex-shrink-0 flex items-center justify-center">
                            <svg class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5-3-8-3z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-medium">Kepala Desa</p>
                            <p class="text-sm font-black text-slate-900">Slamet Rosyidin</p>
                        </div>
                    </div>
                </div>

                <div class="w-0.5 h-6 bg-slate-400 ml-0.5"></div>

                <div class="w-full relative">
                    <div class="absolute top-0 left-1/2 w-[25%] h-0.5 bg-slate-400"></div>
                    <div class="absolute top-0 left-1/2 w-0.5 h-40 bg-slate-400"></div>
                    <div class="absolute top-0 left-[75%] w-0.5 h-6 bg-slate-400"></div>

                    <div class="absolute top-[120px] left-1/2 w-[37.5%] h-0.5 bg-slate-400"></div>
                    <div class="absolute top-[120px] left-[87.5%] w-0.5 h-18 bg-slate-400"></div>

                    <div class="w-full flex justify-end pr-[12.5%] pt-6 relative z-10">
                        <div class="bg-[#FAFAFA] border border-slate-200 shadow-md p-4 rounded-xl flex items-center gap-4 w-64">
                            <div class="w-12 h-12 bg-slate-200 rounded-full flex-shrink-0 flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5-3-8-3z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 font-medium">Sekretaris Desa</p>
                                <p class="text-sm font-black text-slate-900">Slamet Rosyidin</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full grid grid-cols-4 relative mt-13">
                    <div class="col-span-3 relative">
                        <div class="absolute top-0 left-[16.66%] right-[16.66%] h-0.5 bg-slate-400"></div>

                        <div class="grid grid-cols-3 w-full">
                            <div class="flex justify-center">
                                <div class="w-0.5 h- bg-slate-400"></div>
                            </div>
                            <div class="flex justify-center">
                                <div class="w-0.5 h-6 bg-slate-400"></div>
                            </div>
                            <div class="flex justify-center">
                                <div class="w-0.5 h-6 bg-slate-400"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-1"></div>
                </div>

                <div class="w-full relative">
                    <div class="grid grid-cols-4 gap-4 pt-0 w-full">

                        <div class="col-span-3 bg-blue-50/60 border border-blue-100 p-4 rounded-2xl relative z-10">
                            <div class="grid grid-cols-3 gap-4">
                                <div class="bg-[#FAFAFA] border border-slate-200 shadow-md p-4 rounded-xl flex flex-col sm:flex-row items-center text-center sm:text-left gap-3">
                                    <div class="w-10 h-10 bg-slate-200 rounded-full flex-shrink-0 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5-3-8-3z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-[11px] text-slate-500 font-medium">Kasi Pemerintahan</p>
                                        <p class="text-xs font-black text-slate-900">Slamet Rosyidin</p>
                                    </div>
                                </div>

                                <div class="bg-[#FAFAFA] border border-slate-200 shadow-md p-4 rounded-xl flex flex-col sm:flex-row items-center text-center sm:text-left gap-3">
                                    <div class="w-10 h-10 bg-slate-200 rounded-full flex-shrink-0 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5-3-8-3z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-[11px] text-slate-500 font-medium">Kasi Kesejahteraan</p>
                                        <p class="text-xs font-black text-slate-900">Slamet Rosyidin</p>
                                    </div>
                                </div>

                                <div class="bg-[#FAFAFA] border border-slate-200 shadow-md p-4 rounded-xl flex flex-col sm:flex-row items-center text-center sm:text-left gap-3">
                                    <div class="w-10 h-10 bg-slate-200 rounded-full flex-shrink-0 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5-3-8-3z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-[11px] text-slate-500 font-medium">Kasi Pelayanan</p>
                                        <p class="text-xs font-black text-slate-900">Slamet Rosyidin</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-1 flex items-start relative z-10">
                            <div class="bg-[#FAFAFA] border border-slate-200 shadow-md p-4 rounded-xl flex flex-col sm:flex-row items-center text-center sm:text-left gap-3 w-full">
                                <div class="w-10 h-10 bg-slate-200 rounded-full flex-shrink-0 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5-3-8-3z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[11px] text-slate-500 font-medium">Kepala Dusun</p>
                                    <p class="text-xs font-black text-slate-900">Slamet Rosyidin</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="flex justify-center mb-12" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white shadow-sm border border-slate-300 text-sm font-semibold tracking-wide text-slate-700">
                <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                Data Desa
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pb-20" data-aos="fade-up">
            <div class="bg-[#FFFFFF] p-6 rounded-3xl shadow-md border border-slate-200 flex flex-col items-center hover:shadow-lg transition duration-300">
                <h3 class="text-base font-bold text-slate-800 mb-4 w-full text-left px-2">Rasio Penduduk Keseluruhan</h3>
                <div class="w-full max-w-xm h-[240px] flex items-center justify-center bg-[#FAFAFA] rounded-2xl border border-slate-100 p-4 relative">
                    <canvas id="chartPenduduk"></canvas>
                </div>
            </div>

            <div class="bg-[#FFFFFF] p-6 sm:p-8 rounded-3xl shadow-md border border-slate-200 flex flex-col h-[380px] hover:shadow-lg transition duration-300">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Komposisi Agama</h3>
                <div class="flex-grow flex items-center justify-center bg-white rounded-2xl border border-slate-100 p-4 relative">
                    <canvas id="chartAgama"></canvas>
                </div>
            </div>

            <div class="bg-[#FFFFFF] p-6 rounded-3xl shadow-md border border-slate-200 flex flex-col items-center hover:shadow-lg transition duration-300">
                <h3 class="text-base font-bold text-slate-800 mb-4 w-full text-left px-2">Rasio Pendidikan</h3>
                <div class="w-full max-w-xm h-[240px] flex items-center justify-center bg-white rounded-2xl border border-slate-100 p-4 relative">
                    <canvas id="chartPendidikan"></canvas>
                </div>
            </div>

            <div class="bg-[#FFFFFF] p-6 sm:p-8 rounded-3xl shadow-md border border-slate-200 flex flex-col h-[380px] hover:shadow-lg transition duration-300">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Rentang Umur</h3>
                <div class="flex-grow flex items-center justify-center bg-white rounded-2xl border border-slate-100 p-4 relative">
                    <canvas id="chartUmur"></canvas>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Konfigurasi warna global agar senada dengan tema website (Blue & Amber)
            const colors = {
                blue: ['#2563eb', '#3b82f6', '#60a5fa', '#93c5fd', '#bed8fe'],
                amber: ['#d97706', '#f59e0b', '#fbbf24', '#fcd34d', '#fef3c7'],
                mixed: ['#2563eb', '#f59e0b', '#10b981', '#ef4444', '#8b5cf6', '#64748b']
            };

            // 1. Chart Rasio Penduduk (Pie / Doughnut)
            new Chart(document.getElementById('chartPenduduk'), {
                type: 'doughnut',
                data: {
                    labels: ['Laki-laki', 'Perempuan'],
                    datasets: [{
                        data: [1250, 1310],
                        backgroundColor: [colors.blue[0], colors.amber[1]],
                        borderWidth: 0,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });

            // 2. Chart Komposisi Agama (Bar Horizontal / Vertikal)
            new Chart(document.getElementById('chartAgama'), {
                type: 'bar',
                data: {
                    labels: ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha'],
                    datasets: [{
                        label: 'Jumlah Jiwa',
                        data: [2500, 45, 12, 0, 5],
                        backgroundColor: colors.blue[1],
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // 3. Chart Rasio Pendidikan (Pie)
            new Chart(document.getElementById('chartPendidikan'), {
                type: 'pie',
                data: {
                    labels: ['Tidak Sekolah', 'SD', 'SMP', 'SMA/SMK', 'Sarjana (D3/S1)'],
                    datasets: [{
                        data: [300, 600, 750, 800, 110],
                        backgroundColor: colors.mixed,
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                font: {
                                    size: 11
                                }
                            }
                        }
                    }
                }
            });

            // 4. Chart Rentang Umur (Line atau Bar)
            new Chart(document.getElementById('chartUmur'), {
                type: 'line',
                data: {
                    labels: ['0-5 thn', '6-12 thn', '13-17 thn', '18-35 thn', '36-55 thn', '56+ thn'],
                    datasets: [{
                        label: 'Jumlah Orang',
                        data: [150, 280, 310, 850, 620, 350],
                        borderColor: colors.amber[0],
                        backgroundColor: 'rgba(217, 119, 6, 0.1)',
                        fill: true,
                        tension: 0.3,
                        borderWidth: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</div>
@endsection