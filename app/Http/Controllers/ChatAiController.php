<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

// IMPORT MODEL DATABASE
use App\Models\Berita; 
use App\Models\PotensiUmkm; 

class ChatAiController extends Controller
{
    public function sendMessage(Request $request)
    {
        // 1. Validasi input pesan dari warga
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $userMessage = $request->input('message');
        $apiKey = env('GROQ_API_KEY');

        // Proteksi awal jika API Key lupa dimasukkan di file .env
        if (empty($apiKey)) {
            return response()->json([
                'success' => false, 
                'reply' => 'Sistem AI belum siap. Silakan hubungi admin untuk mengisi GROQ_API_KEY di file .env.'
            ]);
        }

        // ==========================================
        // BAGIAN 1: AMBIL DATA DARI FILE TEKS
        // ==========================================
        $dataTeksDesa = "";
        if (Storage::exists('data_desa.txt')) {
            $dataTeksDesa = Storage::get('data_desa.txt');
        }

        // ==========================================
        // BAGIAN 2: AMBIL DATA DARI DATABASE
        // ==========================================
        
        // Ambil 3 berita terbaru dari database
        $dataBerita = "";
        try {
            $berita = Berita::latest()->take(3)->get();
            if ($berita->isNotEmpty()) {
                foreach ($berita as $b) {
                    $kontenBersih = substr(strip_tags($b->konten), 0, 150) . '...';
                    $dataBerita .= "- Judul: " . $b->judul . " (Isi: " . $kontenBersih . ")\n";
                }
            }
        } catch (\Exception $e) {
            $dataBerita = "Gagal memuat data berita terbaru.\n";
        }

        // Ambil semua data potensi / UMKM desa dari database
        $dataPotensi = "";
        try {
            $potensi = PotensiUmkm::all();
            if ($potensi->isNotEmpty()) {
                foreach ($potensi as $p) {
                    $namaUsaha = $p->nama_usaha ?? $p->nama ?? $p->judul ?? 'Unit Usaha';
                    $dataPotensi .= "- " . $namaUsaha . " (Kategori: " . ($p->kategori ?? 'UMKM') . ")\n";
                }
            }
        } catch (\Exception $e) {
            $dataPotensi = "Gagal memuat data potensi UMKM.\n";
        }

        // ==========================================
        // BAGIAN 3: GABUNGKAN SEMUA SEBAGAI PROMPT AI
        // ==========================================
        $systemInstruction = "Kamu adalah Asisten Digital resmi Desa Parengan, Kecamatan Maduran, Kabupaten Lamongan. "
                           . "Tugasmu membantu memberikan informasi profil desa, berita terbaru, potensi UMKM, dan pelayanan surat dengan ramah, santun, dan singkat. "
                           . "Gunakan bahasa Indonesia yang kasual tapi sopan.\n\n"
                           . "BERIKUT ADALAH BASIS DATA RESMI DESA SEBAGAI ACUAN UTAMA KAMU UNTUK MENJAWAB:\n\n"
                           . "[INFORMASI & LAYANAN DESA]\n"
                           . ($dataTeksDesa ?: "Belum ada data tekstual.\n") . "\n"
                           . "[BERITA TERBARU DESA]\n"
                           . ($dataBerita ?: "Belum ada berita terbaru.\n") . "\n"
                           . "[DAFTAR POTENSI & UMKM DESA]\n"
                           . ($dataPotensi ?: "Belum ada data potensi.\n") . "\n"
                           . "ATURAN PENTING:\n"
                           . "1. Jawablah pertanyaan warga HANYA berdasarkan basis data resmi di atas.\n"
                           . "2. Jika pertanyaan warga tidak tercantum di dalam data di atas, jawab dengan santun bahwa informasi tersebut saat ini belum tersedia di sistem AI dan sarankan warga untuk datang langsung ke Balai Desa Parengan.";

        try {
            // 4. Request ke API Groq menggunakan HTTP Client Laravel dengan penataan Header yang ketat
            $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ])
                ->timeout(30)
                ->withoutVerifying()
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'llama-3.3-70b-versatile', 
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => $systemInstruction
                        ],
                        [
                            'role' => 'user',
                            'content' => $userMessage
                        ]
                    ],
                    'temperature' => 0.4,
                ]);

            // 5. Ambil response text dari Groq jika sukses
            if ($response->successful()) {
                $result = $response->json();
                $aiReply = $result['choices'][0]['message']['content'] ?? 'Maaf, sistem AI sedang memproses data lain.';
                
                return response()->json(['success' => true, 'reply' => $aiReply]);
            }

            // Jika gagal (API Key salah/limit habis), tampilkan pesan error spesifik dari Groq untuk mempermudah debug
            $errorDetail = $response->json()['error']['message'] ?? 'Koneksi ditolak oleh Groq.';
            return response()->json([
                'success' => false, 
                'reply' => 'Gagal memproses pesan: ' . $errorDetail
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'reply' => 'Gagal terhubung dengan kecerdasan buatan: ' . $e->getMessage()
            ]);
        }
    }
}