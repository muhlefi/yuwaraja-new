<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            SpvSeeder::class,
            MahasiswaSeeder::class,
            KelompokSeeder::class,
            TugasSeeder::class,
            PengumumanSeeder::class,
            JadwalSeeder::class,
            AbsensiSeeder::class,
            SurveySeeder::class,
            FaqSeeder::class,
            FriendshipSeeder::class,
        ]);
    }
}
