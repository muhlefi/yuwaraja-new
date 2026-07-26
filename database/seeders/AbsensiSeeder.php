<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\AbsensiMahasiswa;
use Illuminate\Database\Seeder;

class AbsensiSeeder extends Seeder
{
    public function run(): void
    {
        // Sesi absensi 1: Hari ini, Upacara Pembukaan (sudah berlangsung)
        $absensi1 = Absensi::create([
            'judul' => 'Absensi Upacara Pembukaan',
            'deskripsi' => 'Absensi untuk kegiatan Upacara Pembukaan PPKMB YUWARAJA 2025',
            'tanggal' => now()->toDateString(),
            'jam_mulai' => '07:00:00',
            'jam_selesai' => '09:00:00',
            'status' => 'aktif',
        ]);

        // Beberapa mahasiswa sudah absen dan di-approve
        AbsensiMahasiswa::create([
            'absensi_id' => $absensi1->id,
            'user_id' => 5, // Ahmad
            'status' => 'approved',
            'waktu_absen' => now()->subHours(2),
            'keterangan' => 'Hadir tepat waktu',
            'approved_by' => 2,
            'approved_at' => now()->subHours(1),
        ]);

        AbsensiMahasiswa::create([
            'absensi_id' => $absensi1->id,
            'user_id' => 6, // Putri
            'status' => 'approved',
            'waktu_absen' => now()->subHours(2)->subMinutes(5),
            'keterangan' => 'Hadir',
            'approved_by' => 2,
            'approved_at' => now()->subHours(1),
        ]);

        AbsensiMahasiswa::create([
            'absensi_id' => $absensi1->id,
            'user_id' => 9, // Bayu
            'status' => 'pending',
            'waktu_absen' => now()->subHours(2)->subMinutes(10),
            'keterangan' => 'Mohon diapprove',
            'approved_by' => null,
            'approved_at' => null,
        ]);

        AbsensiMahasiswa::create([
            'absensi_id' => $absensi1->id,
            'user_id' => 13, // Gilang
            'status' => 'rejected',
            'waktu_absen' => now()->subHours(2)->subMinutes(15),
            'keterangan' => 'Terlambat dari batas waktu',
            'approved_by' => 4,
            'approved_at' => now()->subHours(1),
        ]);

        // Sesi absensi 2: Besok, Pelatihan Kepemimpinan (belum berlangsung)
        Absensi::create([
            'judul' => 'Absensi Pelatihan Kepemimpinan',
            'deskripsi' => 'Absensi untuk kegiatan Pelatihan Kepemimpinan dan Team Building',
            'tanggal' => now()->addDay()->toDateString(),
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '12:00:00',
            'status' => 'aktif',
        ]);

        // Sesi absensi 3: Lusa, Seminar Akademik (belum berlangsung)
        Absensi::create([
            'judul' => 'Absensi Seminar Akademik',
            'deskripsi' => 'Absensi untuk kegiatan Seminar Akademik dan Pengenalan Program Studi',
            'tanggal' => now()->addDays(2)->toDateString(),
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '16:00:00',
            'status' => 'aktif',
        ]);
    }
}
