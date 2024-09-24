<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DialingCode extends Model
{
    use HasFactory;
    protected $fillable = ['country','country_code','dialing_code'];

    public function user()
    {
        return $this->hasMany(DialingCode::class,'dialing_code_id');
    }
}
