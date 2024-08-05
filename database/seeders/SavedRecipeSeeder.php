<?php

namespace Database\Seeders;

use App\Models\SavedRecipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SavedRecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $savedRecipeData = SavedRecipe::all();

        foreach ($savedRecipeData as $data) {
            $data->update([
                'slug' => encrypt('id'),
            ]);
        }
    }
}
