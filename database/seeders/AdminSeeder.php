<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Yuwaraja',
            'nim' => '000000000000',
            'username' => 'admin',
            'email' => 'admin@yuwaraja.com',
            'email_student' => null,
            'program_studi' => 'Sistem Informasi',
            'angkatan' => '2022',
            'nomor_telepon' => '081234567890',
            'tempat_lahir' => 'Malang',
            'tanggal_lahir' => '2003-01-15',
            'jenis_kelamin' => 'Laki-laki',
            'asal_sekolah_jenis' => 'SMA',
            'asal_sekolah_nama' => 'SMA Negeri 1 Malang',
            'jurusan_sekolah' => 'IPA',
            'asal_kota' => 'Malang',
            'alamat_domisili' => 'Jl. Veteran No.1, Kota Malang',
            'alamat_lengkap' => 'Jl. Veteran No.1, Kec. Klojen, Kota Malang, Jawa Timur',
            'provinsi' => 'Jawa Timur',
            'kota' => 'Malang',
            'kota_kabupaten' => 'Kota',
            'jalur_masuk' => 'SNBP',
            'deskripsi' => 'Administrator sistem PPKMB YUWARAJA',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
    }
}
