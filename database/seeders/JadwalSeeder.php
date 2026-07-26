<?php

namespace Database\Seeders;

use App\Models\JadwalAcara;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $jadwal = [
            [
                'nama_acara' => 'Upacara Pembukaan PPKMB',
                'deskripsi' => 'Upacara resmi pembukaan PPKMB YUWARAJA 2025. Seluruh peserta wajib hadir dan mengenakan atribut lengkap.',
                'tanggal_mulai' => now()->startOfDay()->addHours(7),
                'tanggal_selesai' => now()->startOfDay()->addHours(9),
                'lokasi' => 'Gedung Aula Utama UB',
                'status' => 'published',
            ],
            [
                'nama_acara' => 'Pelatihan Kepemimpinan',
                'deskripsi' => 'Sesi pelatihan kepemimpinan dan team building untuk seluruh cluster. Akan ada berbagai games dan tantangan kelompok.',
                'tanggal_mulai' => now()->addDay()->startOfDay()->addHours(8),
                'tanggal_selesai' => now()->addDay()->startOfDay()->addHours(12),
                'lokasi' => 'Lapangan Timur Fakultas Vokasi',
                'status' => 'published',
            ],
            [
                'nama_acara' => 'Seminar Akademik',
                'deskripsi' => 'Seminar pengenalan program studi dan kurikulum oleh para dosen per program studi. Mahasiswa akan mendapat gambaran perkuliahan.',
                'tanggal_mulai' => now()->addDays(2)->startOfDay()->addHours(13),
                'tanggal_selesai' => now()->addDays(2)->startOfDay()->addHours(16),
                'lokasi' => 'Ruang Seminar Gedung B',
                'status' => 'published',
            ],
            [
                'nama_acara' => 'Workshop Kreativitas dan Inovasi',
                'deskripsi' => 'Workshop pengembangan ide kreatif dan inovasi dalam teknologi informasi. Peserta akan dibagi per cluster untuk berkolaborasi.',
                'tanggal_mulai' => now()->addDays(3)->startOfDay()->addHours(9),
                'tanggal_selesai' => now()->addDays(3)->startOfDay()->addHours(15),
                'lokasi' => 'Laboratorium Komputer Gedung C',
                'status' => 'draft',
            ],
        ];

        foreach ($jadwal as $j) {
            JadwalAcara::create($j);
        }
    }
}
