<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Exception;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        $recipeData = Recipe::with(['recipe_origin', 'meal_type', 'season_list_item.season', 'food_group_list_item.food_group'])
            ->where('is_active', 1)
            ->orderBy('name', 'asc')
            ->get();

        if (!$recipeData) {
            return response()->json(false);
        }

        return response()->json($recipeData);
    }

    public function AllRecipe()
    {
        $recipeData = Recipe::with(['recipe_origin', 'meal_type', 'season_list_item.season', 'food_group_list_item.food_group'])
            ->orderBy('name', 'asc')
            ->get();

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

    public function showRecipeByFoodGroup($foodGroupId)
    {
        try {
            $recipeData = Recipe::whereHas('food_group_list_item', function ($query) use ($foodGroupId) {
                $query->where('food_group_id', $foodGroupId);
            })
                ->where('is_active', 1)
                ->orderBy('name', 'asc')
                ->get();

            if (!$recipeData) {
                return response()->json(false);
            }

            return response()->json($recipeData);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }
}
