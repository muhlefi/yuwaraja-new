<?php

namespace Database\Seeders;

use App\Models\Kelompok;
use App\Models\User;
use Illuminate\Database\Seeder;

class KelompokSeeder extends Seeder
{
    public function run(): void
    {
        $kelompoks = [
            [
                'id' => 1,
                'nama_kelompok' => 'Cluster Alpha',
                'spv_id' => 2,
                'code' => 'ALPHA',
                'photo' => null,
            ],
            [
                'id' => 2,
                'nama_kelompok' => 'Cluster Bravo',
                'spv_id' => 3,
                'code' => 'BRAVO',
                'photo' => null,
            ],
            [
                'id' => 3,
                'nama_kelompok' => 'Cluster Charlie',
                'spv_id' => 4,
                'code' => 'CHARL',
                'photo' => null,
            ],
        ];

        foreach ($kelompoks as $kelompok) {
            Kelompok::create($kelompok);
        }

        // Assign mahasiswa ke kelompok
        // Cluster Alpha (id=1): Ahmad(5), Putri(6), Fajar(7), Lestari(8)
        User::whereIn('id', [5, 6, 7, 8])->update(['kelompok_id' => 1]);
        // Cluster Bravo (id=2): Bayu(9), Citra(10), Dwi(11), Eka(12)
        User::whereIn('id', [9, 10, 11, 12])->update(['kelompok_id' => 2]);
        // Cluster Charlie (id=3): Gilang(13), Hana(14), Irfan(15), Jingga(16)
        User::whereIn('id', [13, 14, 15, 16])->update(['kelompok_id' => 3]);
    }
}
