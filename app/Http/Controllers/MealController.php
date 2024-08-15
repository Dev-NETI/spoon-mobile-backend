<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function index()
    {
        $mealData = Meal::where('is_active',  1)->orderBy('id', 'asc')->get();
        if (!$mealData) {
            return response()->json(false);
        }
        return response()->json($mealData);
    }
}
