<?php

namespace Database\Factories;

use App\Models\RecommendedCalorieIntakeHistoryItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RecommendedCalorieIntakeHistoryItemFactory extends Factory
{
    protected $model = RecommendedCalorieIntakeHistoryItem::class;

    public function definition(): array
    {
        $userid = $this->faker->numberBetween(1, 10000);

        return [
            'user_id' => 51,
            'slug' => Str::slug($userid), // Fixed slug generation
            'maintenance_calorie' => $this->faker->randomFloat(2, 1500, 3000), // More realistic range
            'mild_weight_loss' => $this->faker->randomFloat(2, 1400, 2900),
            'weight_loss' => $this->faker->randomFloat(2, 1300, 2800),
            'extreme_weight_loss' => $this->faker->randomFloat(2, 1000, 2500),
            'mild_weight_gain' => $this->faker->randomFloat(2, 1600, 3100),
            'weight_gain' => $this->faker->randomFloat(2, 1700, 3200),
            'extreme_weight_gain' => $this->faker->randomFloat(2, 1800, 3500),
            'is_active' => $this->faker->boolean(),
            'modified_by' => $this->faker->name(),
        ];
    }
}
