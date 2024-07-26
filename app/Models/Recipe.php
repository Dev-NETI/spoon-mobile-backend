<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    public function recipe_rank_list_item()
    {
        return $this->hasMany(RecipeRankListItem::class, 'recipe_id', 'id');
    }

    public function meal_log_item()
    {
        return $this->hasMany(MealLogItem::class, 'recipe_id');
    }

    public function recipe_review()
    {
        return $this->hasMany(RecipeReview::class, 'recipe_id');
    }
}
