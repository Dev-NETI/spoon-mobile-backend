<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'firstname',
        'middlename',
        'lastname',
        'suffix',
        'rank_id',
        'category_id',
        'nationality_id',
        'company',
        'age',
        'date_of_birth',
        'height_imperial',
        'height_metric',
        'weight_imperial',
        'weight_metric',
        'image_path',
        'is_active',
        'modified_by',
        'email',
        'password',
        'calorie_intake',
        'activity_level_id',
        'gender_id',
        'is_first_login',
    ];
    protected $with = ['activity_level', 'bmi_log'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $lastId = $model::orderBy('id', 'DESC')->first();
            $slug = $lastId != NULL ? encrypt($lastId->id + 1) : encrypt(1);
            $model->slug = $slug;
            $model->modified_by = '';
        });

        static::updating(function ($model) {
            $model->modified_by = '';
        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function bmi_log()
    {
        return $this->hasMany(BmiLog::class, 'user_id', 'id');
    }

    public function blood_pressure_log()
    {
        return $this->hasMany(BloodPressureLog::class, 'user_id', 'id');
    }

    public function meal_log_item()
    {
        return $this->hasMany(MealLogItem::class, 'user_id');
    }

    public function recipe_review()
    {
        return $this->hasMany(RecipeReview::class, 'user_id');
    }

    public function recommended_calorie_intake_history_item()
    {
        return $this->hasMany(RecommendedCalorieIntakeHistoryItem::class, 'user_id');
    }

    public function activity_level()
    {
        return $this->belongsTo(ActivityLevel::class, 'activity_level_id');
    }
}
