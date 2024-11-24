<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Store;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tentukan jumlah data
        $storeCount = (int) $this->command->ask('Berapa banyak stores?', 10);
        $userCount = (int) $this->command->ask('Berapa banyak users per store?', 5);
        $itemCount = (int) $this->command->ask('Berapa banyak items per store?', 20);

        // Buat Stores
        $stores = Store::factory($storeCount)->create();

        // Untuk setiap Store, buat Users dan Items
        $stores->each(function ($store) use ($userCount, $itemCount) {
            // Buat satu User dengan role 'pemilik usaha'
            User::factory()->create([
                'store_id' => $store->store_id,
                'role' => 'pemilik usaha',
            ]);

            // Buat Users lain dengan role 'kasir'
            User::factory($userCount - 1)->create([
                'store_id' => $store->store_id,
                'role' => 'kasir',
            ]);

            // Buat Items untuk Store ini
            Item::factory($itemCount)->create([
                'store_id' => $store->store_id,
            ]);
        });

        $this->command->info('Data telah dibuat dengan sukses!');
    }
}
