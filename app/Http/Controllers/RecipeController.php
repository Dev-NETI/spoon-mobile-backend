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
}
