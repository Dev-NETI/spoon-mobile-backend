<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::truncate();
        $data = [
            0 => ['kg'],
            1 => ['g'],
            2 => ['tbsp'],
            3 => ['tsp'],
            4 => ['L'],
            5 => ['ml'],
            6 => ['pc(s)'],
            7 => ['packs'],
            8 => ['strips'],
            9 => ['tbspg'],
            10 => ['k'],
            11 => ['sheet'],
            12 => ['cup'],
        ];
        foreach ($data as $index => [$name]) {
            Unit::create([
                'name' => $name,
            ]);
        }
    }
}
