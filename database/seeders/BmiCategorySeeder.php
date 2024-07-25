<?php

namespace Database\Seeders;

use App\Models\BmiCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BmiCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BmiCategory::truncate();
        $data = [
            0 => ['Underweight'],
            1 => ['Normal Weight'],
            2 => ['Overweight'],
            3 => ['Obese'],
        ];

        foreach ($data as $index => [$name]) {
            BmiCategory::create([
                'name' => $name,
            ]);
        }
    }
}
