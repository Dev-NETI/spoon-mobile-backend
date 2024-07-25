<?php

namespace Database\Seeders;

use App\Models\DietaryReferenceValue;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            RankSeeder::class,
            CategorySeeder::class,
            NationalitySeeder::class,
            RecipeOriginSeeder::class,
            MealTypeSeeder::class,
            UnitSeeder::class,
            SeasonSeeder::class,
            FoodGroupSeeder::class,
            RecipeRankSeeder::class,
            ActivityLevelSeeder::class,
            BmiCategorySeeder::class,
            MealSeeder::class,
            UserCategorySeeder::class,
            CompanySeeder::class,
            DietaryReferenceValueSeeder::class,
        ]);
    }
}
