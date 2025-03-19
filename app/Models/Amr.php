<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amr extends Model
{
    /** @use HasFactory<\Database\Factories\AmrFactory> */
    use HasFactory;
    protected $table = 'Amrs';
    protected $fillable = ['description', 'multiplier'];
}
