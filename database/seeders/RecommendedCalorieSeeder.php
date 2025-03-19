<?php

namespace Database\Seeders;

use App\Models\RecommendedCalorieIntakeHistoryItem;
use Illuminate\Database\Seeder;

class RecommendedCalorieSeeder extends Seeder
{
    public function run(): void
    {
        RecommendedCalorieIntakeHistoryItem::factory()->count(10)->create();
    }
}
