<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredientData = Ingredient::all();

        foreach ($ingredientData as $data) {
            $data->update([
                'slug' => encrypt('id'),
            ]);
        }
    }
}
