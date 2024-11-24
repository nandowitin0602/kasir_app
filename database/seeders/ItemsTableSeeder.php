<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            [
                'item_code' => 'A001',
                'item_name' => 'Item 1',
                'item_price' => 15000,
                'stock' => 100,
                'selling_unit' => '/kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_code' => 'ITEM002',
                'item_name' => 'Item 2',
                'item_price' => 5000,
                'stock' => 200,
                'selling_unit' => '/satuan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
