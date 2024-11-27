<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_code' => $this->faker->unique()->numerify('ITEM###'),
            'item_name' => $this->faker->word,
            'item_price' => $this->faker->randomFloat(2, 10, 10000),
            'stock' => $this->faker->randomFloat(2, 10, 10000),
            'selling_unit' => $this->faker->randomElement(['/kg', '/satuan']),
            'is_deleted' => $this->faker->randomElement(['y', 'n']),
            'created_at' => now(),
            'updated_at' => now(),
            'store_id' => Store::inRandomOrder()->first()->store_id,
        ];
    }
}
