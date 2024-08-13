<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'name',
        'breakfast',
        'lunch',
        'dinner',
        'snack',
        'calories',
        'carbohydrate',
        'protein',
        'fat',
        'sodium',
        'fiber',
        'meal_type_id',
        'recipe_origin_id',
        'number_of_serving',
        'image_path',
        'is_active',
        'modified_by'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $lastId = $model::orderBy('id', 'DESC')->first();
            $slug = $lastId != NULL ? encrypt($lastId->id + 1) : encrypt(1);
            $model->slug = $slug;
            $model->modified_by = 'system';
        });

        static::updating(function ($model) {
            $model->modified_by = 'system';
        });
    }

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

    public function meal_type()
    {
        return $this->belongsTo(MealType::class, 'meal_type_id');
    }

    public function food_group_list_item()
    {
        return $this->hasMany(FoodGroupListItem::class, 'recipe_id');
    }

    public function season_list_item()
    {
        return $this->hasMany(SeasonListItem::class, 'recipe_id');
    }

    public function ingredient()
    {
        return $this->hasMany(Ingredient::class, 'recipe_id');
    }

    public function procedure()
    {
        return $this->hasMany(Procedure::class, 'recipe_id');
    }
}
