<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeasonListItem extends Model
{
    use HasFactory;
    protected $fillable = ['slug', 'recipe_id', 'season_id', 'is_active', 'modified_by'];

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

    public function season()
    {
        return $this->belongsTo(Season::class, 'season_id');
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'recipe_id');
    }
}
