<?php

namespace Database\Seeders;

use App\Models\UserCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserCategory::truncate();
        $data = [
            0 => ['Seafarer (Officer)'],
            1 => ['Seafarer (Ratings)'],
            2 => ['Seafarers (Dependent)'],
            3 => ['Land-based Employee'],
        ];

        foreach ($data as $index => [$name]) {
            UserCategory::create([
                'name' => $name,
            ]);
        }
    }
}
