<?php

namespace Database\Seeders;

use App\Models\Meal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Meal::truncate();
        $data = [
            0 => ['Breakfast'],
            1 => ['Lunch'],
            2 => ['Dinner'],
            3 => ['Snack'],
        ];

        foreach ($data as $index => [$name]) {
            Meal::create([
                'name' => $name,
            ]);
        }
    }
}
