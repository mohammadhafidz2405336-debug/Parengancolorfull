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

        function openModal(jabatan, nama, tupoksi, email, jam, foto) {
            document.getElementById('modalJabatan').innerText = jabatan;
            document.getElementById('modalNama').innerText = nama;
            document.getElementById('modalTupoksi').innerText = tupoksi;
            document.getElementById('modalEmail').innerText = email;
            document.getElementById('modalJam').innerText = jam;

            // Handle Perubahan Foto secara dinamis di Modal
            const fotoContainer = document.getElementById('modalFotoContainer');
            if (foto && foto !== '') {
                fotoContainer.innerHTML = `<img src="/storage/${foto}" class="w-full h-full object-cover">`;
            } else {
                fotoContainer.innerHTML = `<svg class="w-12 h-12 text-slate-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5-3-8-3z" /></svg>`;
            }

            const modal = document.getElementById('perangkatModal');
            const card = document.getElementById('modalCard');
            
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100', 'pointer-events-auto');

            if (window.innerWidth >= 768) { 
                setTimeout(() => {
                    card.classList.remove('md:translate-x-full');
                    card.classList.add('md:translate-x-0');
                }, 50);
            } else { 
                setTimeout(() => {
                    card.classList.remove('scale-95');
                    card.classList.add('scale-100');
                }, 50);
            }
        }
        
        function closeModal() {
            const modal = document.getElementById('perangkatModal');
            const card = document.getElementById('modalCard');
            
            // Sembunyikan card berdasarkan ukuran layar terlebih dahulu
            if (window.innerWidth >= 768) {
                card.classList.remove('md:translate-x-0');
                card.classList.add('md:translate-x-full');
            } else {
                card.classList.remove('scale-100');
                card.classList.add('scale-95');
            }

            // Sembunyikan background gelap setelah animasi card selesai
            setTimeout(() => {
                modal.classList.remove('opacity-100', 'pointer-events-auto');
                modal.classList.add('opacity-0', 'pointer-events-none');
            }, 250);
        }

        // Klik latar gelap untuk menutup panel
        window.onclick = function(event) {
            const modal = document.getElementById('perangkatModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>