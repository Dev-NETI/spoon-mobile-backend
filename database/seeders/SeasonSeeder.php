<?php

namespace Database\Seeders;

use App\Models\Season;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Season::truncate();
        $data = [
            0 => ['Stormy Weather'],
            1 => ['Hot Weather'],
            2 => ['Cold Weather'],
            3 => ['Heavy Labor'],
        ];
        foreach ($data as $index => [$name]) {
            Season::create([
                'name' => $name,
            ]);
        }
    }
}
