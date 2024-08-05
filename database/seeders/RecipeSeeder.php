<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipeData = Recipe::all();

        foreach ($recipeData as $recipe) {
            $recipe->update([
                'slug' => encrypt('id'),
            ]);
        }
    }
}
