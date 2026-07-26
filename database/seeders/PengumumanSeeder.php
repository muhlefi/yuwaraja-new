<?php

namespace Database\Seeders;

use App\Models\Pengumuman;
use Illuminate\Database\Seeder;

class PengumumanSeeder extends Seeder
{
    public function run(): void
    {
        $pengumuman = [
            [
                'judul' => 'Selamat Datang di PPKMB YUWARAJA 2025!',
                'konten' => "Kepada seluruh mahasiswa baru Fakultas Vokasi Universitas Brawijaya,\n\nSelamat datang di PPKMB YUWARAJA 2025! Kami sangat antusias menyambut kalian sebagai bagian dari keluarga besar Fakultas Vokasi.\n\nBeberapa informasi penting:\n1. PPKMB akan berlangsung selama 5 hari\n2. Wajib hadir tepat waktu setiap harinya\n3. Gunakan atribut yang sudah ditentukan\n4. Jaga selalu kesehatan dan stamina\n\nSemoga PPKMB ini menjadi awal yang baik untuk perjalanan akademik kalian!",
                'tipe' => 'umum',
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'judul' => 'Jadwal Lengkap PPKMB YUWARAJA 2025',
                'konten' => "Berikut jadwal lengkap PPKMB YUWARAJA 2025:\n\nHari 1 (Senin): Upacara Pembukaan & Orientasi Kampus\nHari 2 (Selasa): Pelatihan Kepemimpinan & Team Building\nHari 3 (Rabu): Seminar Akademik & Pengenalan Program Studi\nHari 4 (Kamis): Workshop Kreativitas & Inovasi\nHari 5 (Jumat): Upacara Penutupan & Evaluasi\n\nSetiap hari dimulai pukul 07.00 WIB. Jangan lupa sarapan dan bawa bekal yang cukup!",
                'tipe' => 'penting',
                'is_published' => true,
                'published_at' => now()->subDays(4),
            ],
            [
                'judul' => 'Pengumuman Pembagian Cluster',
                'konten' => "Seluruh mahasiswa baru sudah dibagi ke dalam cluster-cluster.\n\nSilakan cek dashboard kalian untuk mengetahui cluster mana yang kalian masuki. Setiap cluster akan dibimbing oleh seorang supervisor (SPV).\n\nJika belum tergabung dalam cluster, segera hubungi panitia atau gunakan kode cluster yang tersedia di dashboard.",
                'tipe' => 'penting',
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'judul' => 'Tugas Pertama Sudah Tersedia',
                'konten' => "Tugas pertama sudah tersedia di menu Tugas!\n\n1. Video Profil Kelompok - Deadline: 5 hari lagi\n2. Essay Pengalaman PKKMB - Deadline: 3 hari lagi\n\nPerhatikan deadline dan format pengumpulan yang sudah ditentukan. Semangat mengerjakan!",
                'tipe' => 'umum',
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'judul' => 'Survey Kepuasan PKKMB',
                'konten' => "Kepada seluruh peserta PKKMB,\n\nMohon untuk mengisi survey kepuasan mengenai kegiatan PKKMB yang sudah berlangsung. Survey ini penting untuk evaluasi dan perbaikan kegiatan serupa di masa depan.\n\nSilakan akses survey melalui menu Survey di dashboard kalian.",
                'tipe' => 'umum',
                'is_published' => true,
                'published_at' => now()->subDay(),
            ],
        ];

        foreach ($pengumuman as $p) {
            Pengumuman::create($p);
        }
    }
}
