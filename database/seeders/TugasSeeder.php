<?php

namespace Database\Seeders;

use App\Models\PengumpulanTugas;
use App\Models\Tugas;
use Illuminate\Database\Seeder;

class TugasSeeder extends Seeder
{
    public function run(): void
    {
        $tugas = [
            [
                'id' => 1,
                'judul' => 'Membuat Video Profil Kelompok',
                'deskripsi' => 'Buatlah video profil kelompok dengan durasi maksimal 3 menit. Video harus memuat perkenalan anggota kelompok, visi-misi, dan kegiatan selama PKKMB. Upload ke link drive cluster, lalu kumpulkan link di sini.',
                'deadline' => now()->addDays(5),
                'tipe' => 'kelompok',
                'is_active' => true,
                'file_path' => null,
            ],
            [
                'id' => 2,
                'judul' => 'Essay Pengalaman PKKMB',
                'deskripsi' => 'Tulislah essay tentang pengalaman pertama mengikuti PKKMB di Universitas Brawijaya. Minimal 500 kata. Upload ke link drive cluster, lalu kumpulkan link di sini.',
                'deadline' => now()->addDays(3),
                'tipe' => 'individual',
                'is_active' => true,
                'file_path' => null,
            ],
            [
                'id' => 3,
                'judul' => 'Laporan Jurnal Harian',
                'deskripsi' => 'Buatlah laporan jurnal harian selama kegiatan PKKMB berlangsung. Catat setiap kegiatan, pembelajaran, dan tantangan yang dihadapi. Upload ke link drive cluster, lalu kumpulkan link di sini.',
                'deadline' => now()->addDays(7),
                'tipe' => 'individual',
                'is_active' => true,
                'file_path' => null,
            ],
            [
                'id' => 4,
                'judul' => 'Membuat Desain Logo Kelompok',
                'deskripsi' => 'Buatlah desain logo untuk kelompok kalian. Logo harus mencerminkan identitas dan semangat kelompok. Upload ke link drive cluster, lalu kumpulkan link di sini.',
                'deadline' => now()->addDays(10),
                'tipe' => 'kelompok',
                'is_active' => false,
                'file_path' => null,
            ],
        ];

        foreach ($tugas as $t) {
            Tugas::create($t);
        }

        // Simulasikan beberapa pengumpulan tugas via link drive
        // Kelompok Alpha submit tugas kelompok (tugas_id=1)
        PengumpulanTugas::create([
            'tugas_id' => 1,
            'user_id' => 5,
            'kelompok_id' => 1,
            'file_path' => null,
            'link_drive' => 'https://drive.google.com/file/d/1alpha_video_profil/view',
            'keterangan' => 'Video profil Cluster Alpha sudah jadi! Ada perkenalan semua anggota.',
            'status' => 'submitted',
            'nilai' => null,
            'feedback' => null,
            'submitted_at' => now()->subDays(1),
        ]);

        // Ahmad submit essay (tugas_id=2)
        PengumpulanTugas::create([
            'tugas_id' => 2,
            'user_id' => 5,
            'kelompok_id' => 1,
            'file_path' => null,
            'link_drive' => 'https://drive.google.com/file/d/1ahmad_essay/view',
            'keterangan' => 'Essay pengalaman PKKMB',
            'status' => 'done',
            'nilai' => 85,
            'feedback' => 'Essay yang bagus! Refleksi mendalam tentang pengalaman PKKMB.',
            'submitted_at' => now()->subDays(2),
        ]);

        // Putri submit essay (tugas_id=2)
        PengumpulanTugas::create([
            'tugas_id' => 2,
            'user_id' => 6,
            'kelompok_id' => 1,
            'file_path' => null,
            'link_drive' => 'https://drive.google.com/file/d/1putri_essay/view',
            'keterangan' => 'Tugas essay PKKMB',
            'status' => 'done',
            'nilai' => 90,
            'feedback' => 'Sangat baik! Tulisan terstruktur dan menarik.',
            'submitted_at' => now()->subDays(2),
        ]);

        // Bayu submit essay (tugas_id=2)
        PengumpulanTugas::create([
            'tugas_id' => 2,
            'user_id' => 9,
            'kelompok_id' => 2,
            'file_path' => null,
            'link_drive' => 'https://drive.google.com/file/d/1bayu_essay/view',
            'keterangan' => 'Essay individu',
            'status' => 'submitted',
            'nilai' => null,
            'feedback' => null,
            'submitted_at' => now()->subDay(),
        ]);

        // Gilang submit essay (tugas_id=2)
        PengumpulanTugas::create([
            'tugas_id' => 2,
            'user_id' => 13,
            'kelompok_id' => 3,
            'file_path' => null,
            'link_drive' => 'https://drive.google.com/file/d/1gilang_essay/view',
            'keterangan' => 'Essay pengalaman PKKMB',
            'status' => 'rejected',
            'nilai' => null,
            'feedback' => 'Tolong perbaiki bagian refleksi, belum cukup mendalam.',
            'submitted_at' => now()->subDay(),
        ]);

        // Laporan jurnal - belum ada yang submit
    }
}
