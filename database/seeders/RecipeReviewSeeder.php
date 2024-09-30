<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\RecipeReview;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RecipeReview::truncate();
        
        for ($x = 0; $x <= 80; $x++) {
            RecipeReview::create([
                'recipe_id' => Recipe::inRandomOrder()->first()->id, 
                'user_id' => User::inRandomOrder()->first()->id,     
                'rating' => rand(1, 5),                             
                'comment' => fake()->paragraph()
            ]);
        }
    }
}
