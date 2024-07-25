<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodPressureLog extends Model
{
    use HasFactory;
    protected $fillable = ['slug', 'user_id', 'systolic', 'diastolic', 'is_active', 'modified_by'];

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
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
