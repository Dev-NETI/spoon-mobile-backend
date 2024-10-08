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
        'user_type_id',
        'contact_number',
        'dialing_code_id',
    ];
    protected $with = ['activity_level', 'bmi_log', 'category', 'rank', 'nationality', 'company', 'dialing_code'];

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

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class, 'rank_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company');
    }

    public function dialing_code()
    {
        return $this->belongsTo(DialingCode::class, 'dialing_code_id');
    }

    public function formal_name()
    {
        return $this->firstname . ' ' . $this->middlename . ' ' . $this->lastname . ' ' . $this->suffix;
    }

    public function getFullNameAttribute()
    {
        $middleInitial = $this->middlename ? strtoupper(substr($this->middlename, 0, 1)) . '.' : '';
        $suffix = $this->suffix ? ' AND ' . strtoupper($this->suffix) : '';

        return strtoupper($this->firstname . ' ' . $middleInitial . ' ' . $this->lastname) . $suffix;
    }
}
