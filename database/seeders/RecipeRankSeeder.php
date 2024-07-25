<?php

namespace Database\Seeders;

use App\Models\RecipeRank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeRankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RecipeRank::truncate();
        $data = [
            0 => ['TOP 1'],
            1 => ['TOP 2'],
            2 => ['TOP 3'],
            3 => ['TOP 4'],
            4 => ['TOP 5'],
            5 => ['TOP 6'],
            6 => ['TOP 7'],
            7 => ['TOP 8'],
            8 => ['TOP 9'],
            9 => ['TOP 10'],
        ];

        foreach ($data as $index => [$name]) {
            RecipeRank::create([
                'name' => $name,
            ]);
        }
    }
}
