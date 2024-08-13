<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        $recipeData = Recipe::where('is_active', 1)->orderBy('name', 'asc')->get();

        if (!$recipeData) {
            return response()->json(false);
        }

        return response()->json($recipeData);
    }

    public function show($slug)
    {
        $recipeData = Recipe::with([
            'meal_type',
            'food_group_list_item.food_group',
            'season_list_item.season',
            'ingredient',
            'procedure',
        ])
            ->where('slug', $slug)
            ->where('is_active', 1)
            ->first();

        if (!$recipeData) {
            return response()->json(false);
        }

        return response()->json($recipeData);
    }
}
