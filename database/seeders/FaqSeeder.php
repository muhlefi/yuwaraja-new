<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Apa itu PPKMB YUWARAJA?',
                'answer' => 'PPKMB (Program Pengenalan Kehidupan Kampus Mahasiswa Baru) YUWARAJA adalah program orientasi yang diselenggarakan oleh Fakultas Vokasi Universitas Brawijaya untuk menyambut mahasiswa baru. Program ini bertujuan mengenalkan kehidupan kampus, akademik, dan kegiatan kemahasiswaan.',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'question' => 'Bagaimana cara join cluster?',
                'answer' => 'Untuk bergabung ke dalam cluster, masuk ke menu "Join Kelompok" di dashboard mahasiswa. Masukkan 5 digit kode cluster yang diberikan oleh supervisor. Setelah itu, kamu akan otomatis tergabung dalam cluster tersebut.',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'question' => 'Bagaimana cara mengumpulkan tugas?',
                'answer' => 'Masuk ke menu "Tugas" di dashboard, pilih tugas yang ingin dikerjakan, klik "Kerjakan", lalu upload file jawaban kamu. Pastikan file sesuai format yang diminta (PDF, DOC, DOCX, ZIP, atau RAR) dan ukuran maksimal 10MB.',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'question' => 'Bagaimana cara mengajukan absensi?',
                'answer' => 'Buka menu "Absensi" di dashboard, pilih sesi absensi yang sedang aktif, lalu klik "Ajukan Absensi". Pastikan kamu mengajukan dalam rentang waktu yang ditentukan (jam mulai sampai jam selesai). Absensi akan diverifikasi oleh supervisor.',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'question' => 'Bagaimana cara mengisi survey?',
                'answer' => 'Jika ada survey yang aktif, akan muncul notifikasi di dashboard kamu. Klik menu "Survey", pilih survey yang tersedia, jawab semua pertanyaan, lalu klik "Submit". Pastikan menjawab pertanyaan yang wajib diisi.',
                'is_active' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
