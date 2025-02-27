<?php

namespace App\Http\Controllers;

use App\Http\Resources\SavedRecipeResources;
use App\Models\SavedRecipe;
use Exception;
use Illuminate\Http\Request;

class SavedRecipeController extends Controller
{
    public function index()
    {
        $savedRecipes = SavedRecipe::from('saved_recipes as a')
            ->join('recipes as b', 'a.recipe_id', '=', 'b.id')
            ->join('recipe_origins as c', 'b.recipe_origin_id', '=', 'c.id')
            ->where('a.is_active', 1)
            ->orderBy('a.modified_by', 'asc')
            ->select([
                'a.modified_by',
                'b.name',
                'b.image_path AS recipe_img',
                'c.name AS origin_name',
                'c.image_path',
                'b.slug',
            ])
            ->get();

        return response()->json($savedRecipes);
    }

    public function show($user)
    {
        // $savedRecipes = SavedRecipe::with(['recipe.mealType'])
        //     ->from('saved_recipes as a')
        //     ->join('recipes as b', 'a.recipe_id', '=', 'b.id')
        //     ->join('recipe_origins as c', 'b.recipe_origin_id', '=', 'c.id')
        //     ->where('a.is_active', 1)
        //     ->where('a.user_id', $user)
        //     ->orderBy('a.modified_by', 'asc')
        //     ->with(['b.meal_type'])
        //     ->select([
        //         'a.modified_by',
        //         'b.name',
        //         'b.id',
        //         'b.image_path AS recipe_img',
        //         'c.name AS origin_name',
        //         'c.image_path',
        //         'b.slug',
        //     ])
        //     ->get();

        $savedRecipes = SavedRecipeResources::collection(SavedRecipe::with('recipe')
            ->with('recipe.meal_type')
            ->with('recipe.recipe_origin')
            ->where('is_active', 1)
            ->where('user_id', $user)
            ->orderBy('modified_by', 'asc')
            ->get());

        return response()->json($savedRecipes);
    }

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
