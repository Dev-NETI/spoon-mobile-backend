<?php

namespace Database\Seeders;

use App\Models\DietaryReferenceValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DietaryReferenceValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DietaryReferenceValue::truncate();
        $data = [
            0 => ['Lower Limit', '2167', '305', '40', '60', '0', '0'],
            1 => ['Appropriate value', '2709', '373', '50', '83', '1500', '30'],
            2 => ['Upper limit', '3250', '440', '60', '105', '2300', '0'],
        ];

        foreach ($data as $index => [$name, $calories, $carbs, $protein, $fat, $sodium, $fiber]) {
            DietaryReferenceValue::create([
                'name' => $name,
                'calories' => $calories,
                'carbohydrate' => $carbs,
                'protein' => $protein,
                'fat' => $fat,
                'sodium' => $sodium,
                'fiber' => $fiber,
            ]);
        }
    }
}
