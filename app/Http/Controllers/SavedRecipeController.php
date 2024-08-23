<?php

namespace App\Http\Controllers;

use App\Models\SavedRecipe;
use Exception;
use Illuminate\Http\Request;

class SavedRecipeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'recipeId' => 'required',
            'userId' => 'required'
        ]);

        try {
            $store = SavedRecipe::create([
                'recipe_id' => $request['recipeId'],
                'user_id' => $request['userId'],
            ]);

            if (!$store) {
                return response()->json(false);
            }
            return response()->json(true);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }

    public function unFavoriteRecipe($recipeId, $userId)
    {
        try {
            $favoriteData = SavedRecipe::where('recipe_id', $recipeId)->where('user_id', $userId)->first();

            if (!$favoriteData) {
                return response()->json(false);
            }

            $destroy = $favoriteData->delete();

            if (!$destroy) {
                return response()->json(false);
            }
            return response()->json(true);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }

    public function showSavedRecipe($recipeId, $userId)
    {
        $savedRecipeData = SavedRecipe::where('recipe_id', $recipeId)->where('user_id', $userId)->where('is_active', 1)->first();
        if (!$savedRecipeData) {
            return response()->json(false);
        }
        return response()->json($savedRecipeData);
    }
}
