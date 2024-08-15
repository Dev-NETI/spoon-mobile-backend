<?php

namespace App\Http\Controllers;

use App\Models\MealType;
use Illuminate\Http\Request;

class MealTypeController extends Controller
{
    public function index()
    {
        $mealTypeData = MealType::where('is_active',  1)->orderBy('name', 'asc')->get();
        if (!$mealTypeData) {
            return response()->json(false);
        }
        return response()->json($mealTypeData);
    }
}
