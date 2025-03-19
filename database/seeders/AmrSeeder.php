<?php

namespace Database\Seeders;

use App\Models\Amr;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Amr::truncate();

        $data = [
            [
                'description' => 'BMR',
                'multiplier' => '1'
            ],
            [
                'description' => 'Sedentary (little or no exercise)',
                'multiplier' => '1.2'
            ],
            [
                'description' => 'Lightly active (exercise 1 to 3 days/week)',
                'multiplier' => '1.375'
            ],
            [
                'description' => 'Moderately active (exercise 3 to 5 days/week)',
                'multiplier' => '1.55'
            ],
            [
                'description' => 'Active (exercise 6 to 7 days/week)',
                'multiplier' => '1.725'
            ],
            [
                'description' => 'Very active (hard exercise 6 to 7 days/week)',
                'multiplier' => '1.9'
            ]
        ];

        foreach ($data as $key => $value) {
            Amr::create($value);
        }
    }
}
