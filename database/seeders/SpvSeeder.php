<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SpvSeeder extends Seeder
{
    public function run(): void
    {
        $spvs = [
            [
                'name' => 'Rina Putri Wulandari',
                'nim' => '233140707111001',
                'username' => 'rina',
                'email' => 'rina@students.ub.ac.id',
                'email_student' => 'rina@students.ub.ac.id',
                'program_studi' => 'Teknologi Informasi',
                'angkatan' => '2023',
                'nomor_telepon' => '081345678901',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2004-03-20',
                'jenis_kelamin' => 'Perempuan',
                'asal_sekolah_jenis' => 'SMA',
                'asal_sekolah_nama' => 'SMA Negeri 5 Surabaya',
                'jurusan_sekolah' => 'IPA',
                'asal_kota' => 'Surabaya',
                'alamat_domisili' => 'Jl. Dinoyo No.42, Malang',
                'alamat_lengkap' => 'Jl. Dinoyo No.42, Kec. Klojen, Kota Malang, Jawa Timur',
                'provinsi' => 'Jawa Timur',
                'kota' => 'Malang',
                'kota_kabupaten' => 'Kota',
                'jalur_masuk' => 'SNBT',
                'deskripsi' => 'Supervisor Cluster Alpha - Mahasiswa aktif dan ramah',
                'password' => Hash::make('password'),
                'role' => 'spv',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Dimas Aditya Pratama',
                'nim' => '233140707111002',
                'username' => 'dimas',
                'email' => 'dimas@students.ub.ac.id',
                'email_student' => 'dimas@students.ub.ac.id',
                'program_studi' => 'Teknik Informatika',
                'angkatan' => '2023',
                'nomor_telepon' => '082345678901',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2004-07-10',
                'jenis_kelamin' => 'Laki-laki',
                'asal_sekolah_jenis' => 'SMK',
                'asal_sekolah_nama' => 'SMK Negeri 3 Jakarta',
                'jurusan_sekolah' => 'Rekayasa Perangkat Lunak',
                'asal_kota' => 'Jakarta',
                'alamat_domisili' => 'Jl. Soekarno Hatta No.9, Malang',
                'alamat_lengkap' => 'Jl. Soekarno Hatta No.9, Kec. Lowokwaru, Kota Malang, Jawa Timur',
                'provinsi' => 'Jawa Timur',
                'kota' => 'Malang',
                'kota_kabupaten' => 'Kota',
                'jalur_masuk' => 'Mandiri UB',
                'deskripsi' => 'Supervisor Cluster Bravo - Teknologi dan inovasi',
                'password' => Hash::make('password'),
                'role' => 'spv',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Sari Dewi Kusuma',
                'nim' => '233140707111003',
                'username' => 'sari',
                'email' => 'sari@students.ub.ac.id',
                'email_student' => 'sari@students.ub.ac.id',
                'program_studi' => 'Sistem Informasi',
                'angkatan' => '2023',
                'nomor_telepon' => '083456789012',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '2004-11-05',
                'jenis_kelamin' => 'Perempuan',
                'asal_sekolah_jenis' => 'SMA',
                'asal_sekolah_nama' => 'SMA Negeri 3 Bandung',
                'jurusan_sekolah' => 'IPS',
                'asal_kota' => 'Bandung',
                'alamat_domisili' => 'Jl. Jendral Sudirman No.15, Malang',
                'alamat_lengkap' => 'Jl. Jendral Sudirman No.15, Kec. Klojen, Kota Malang, Jawa Timur',
                'provinsi' => 'Jawa Timur',
                'kota' => 'Malang',
                'kota_kabupaten' => 'Kota',
                'jalur_masuk' => 'SNBP',
                'deskripsi' => 'Supervisor Cluster Charlie - Kreatif dan komunikatif',
                'password' => Hash::make('password'),
                'role' => 'spv',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($spvs as $spv) {
            User::create($spv);
        }
    }
}
