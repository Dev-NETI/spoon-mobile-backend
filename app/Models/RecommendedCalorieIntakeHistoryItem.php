<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecommendedCalorieIntakeHistoryItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug', 'user_id', 'maintenance_calorie', 'mild_weight_loss', 'weight_loss', 'extreme_weight_loss', 'mild_weight_gain',
        'weight_gain', 'extreme_weight_gain', 'is_active', 'modified_by'
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
