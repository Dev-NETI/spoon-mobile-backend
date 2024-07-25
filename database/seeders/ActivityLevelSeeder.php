<?php

namespace Database\Seeders;

use App\Models\ActivityLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivityLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ActivityLevel::truncate();
        $data = [
            0 => ['BMR', 1],
            1 => ['Sedentary (little or no exercise)', 1.2],
            2 => ['Lightly active (exercise 1 to 3 days/week)', 1.375],
            3 => ['Moderately active (exercise 3 to 5 days/week)', 1.55],
            4 => ['Active (exercise 6 to 7 days/week)', 1.725],
            5 => ['Very active (hard exercise 6 to 7 days/week)', 1.9],
        ];

        foreach ($data as $index => [$name, $multiplier]) {
            ActivityLevel::create([
                'name' => $name,
                'multiplier' => $multiplier,
            ]);
        }
    }
}
