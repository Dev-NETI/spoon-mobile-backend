<?php

namespace Database\Seeders;

use App\Models\MealType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MealTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MealType::truncate();
        $data = [
            0 => ['Main Course'],
            1 => ['Side Dish'],
            2 => ['Salad'],
            3 => ['Desert'],
            4 => ['Soup'],
        ];
        foreach ($data as $index => [$name]) {
            MealType::create([
                'name' => $name,
            ]);
        }
    }
}
