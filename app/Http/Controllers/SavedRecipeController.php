<?php

namespace App\Http\Controllers;

use App\Models\SavedRecipe;
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
                'c.image_path'
            ])
            ->get();

        return response()->json($savedRecipes);
    }

    public function show($user){
         $savedRecipes = SavedRecipe::from('saved_recipes as a')
            ->join('recipes as b', 'a.recipe_id', '=', 'b.id')
            ->join('recipe_origins as c', 'b.recipe_origin_id', '=', 'c.id')
            ->where('a.is_active', 1)
            ->where('a.user_id', $user)
            ->orderBy('a.modified_by', 'asc')
            ->select([
                'a.modified_by',
                'b.name',
                'b.image_path AS recipe_img',
                'c.name AS origin_name',
                'c.image_path'
            ])
            ->get();

        return response()->json($savedRecipes);
    }
}
