<?php

namespace Database\Seeders;

use App\Models\Friendship;
use Illuminate\Database\Seeder;

class FriendshipSeeder extends Seeder
{
    public function run(): void
    {
        // Cluster Alpha (id=1): Ahmad, Putri, Fajar, Lestari
        // Beberapa sudah berteman
        Friendship::create([
            'user_id' => 5, // Ahmad
            'friend_id' => 6, // Putri
            'status' => 'accepted',
        ]);

        Friendship::create([
            'user_id' => 5, // Ahmad
            'friend_id' => 7, // Fajar
            'status' => 'accepted',
        ]);

        Friendship::create([
            'user_id' => 6, // Putri
            'friend_id' => 8, // Lestari
            'status' => 'accepted',
        ]);

        // Pending request
        Friendship::create([
            'user_id' => 7, // Fajar
            'friend_id' => 8, // Lestari
            'status' => 'pending',
        ]);

        // Cluster Bravo (id=2): Bayu, Citra, Dwi, Eka
        Friendship::create([
            'user_id' => 9, // Bayu
            'friend_id' => 10, // Citra
            'status' => 'accepted',
        ]);

        Friendship::create([
            'user_id' => 10, // Citra
            'friend_id' => 11, // Dwi
            'status' => 'pending',
        ]);

        // Cluster Charlie (id=3): Gilang, Hana, Irfan, Jingga
        Friendship::create([
            'user_id' => 13, // Gilang
            'friend_id' => 14, // Hana
            'status' => 'accepted',
        ]);

        Friendship::create([
            'user_id' => 14, // Hana
            'friend_id' => 16, // Jingga
            'status' => 'accepted',
        ]);

        Friendship::create([
            'user_id' => 13, // Gilang
            'friend_id' => 15, // Irfan
            'status' => 'pending',
        ]);
    }
}
