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

    public function store(Request $request)
    {
        // return response()->json($request->all());

        // $request->validate([
        //     'recipe_name' => 'required|string',
        //     'meal_type_id' => 'required|integer|min:1',
        //     'number_of_serving' => 'required|integer|min:1',
        //     'recipe_origin_id' => 'required|integer|min:1',
        //     'breakfast' => 'required|integer|in:0,1',
        //     'lunch' => 'required|integer|in:0,1',
        //     'dinner' => 'required|integer|in:0,1',
        //     'ingredients' => 'required|array',
        //     'ingredients.*.ingredient' => 'required|string',
        //     'ingredients.*.calories' => 'required|integer|min:0',
        //     'ingredients.*.carbohydrate' => 'required|integer|min:0',
        //     'ingredients.*.protein' => 'required|integer|min:0',
        //     'ingredients.*.fat' => 'required|integer|min:0',
        //     'ingredients.*.sodium' => 'required|integer|min:0',
        //     'ingredients.*.fiber' => 'required|integer|min:0',
        //     'instructions' => 'required|array',
        //     'instructions.*.number' => 'required|integer|min:1',
        //     'instructions.*.description' => 'required|string',
        // ]);

        try {

            $calories = 0;
            $carbohydrate = 0;
            $protein = 0;
            $fat = 0;
            $sodium = 0;
            $fiber = 0;

            foreach ($request['ingredients'] as $key => $value) {
                $calories += $value['calories'];
                $carbohydrate += $value['carbohydrate'];
                $protein += $value['protein'];
                $fat += $value['fat'];
                $sodium += $value['sodium'];
                $fiber += $value['fiber'];
            }

            $store = Recipe::create([
                'name' => $request['recipe_name'],
                'meal_type_id' => $request['meal_type_id'],
                'number_of_serving' => $request['number_of_serving'],
                'recipe_origin_id' => $request['recipe_origin_id'],
                'breakfast' => $request['breakfast'],
                'lunch' => $request['lunch'],
                'snack' => $request['snack'],
                'dinner' => $request['dinner'],
                'calories' => $calories,
                'carbohydrate' => $carbohydrate,
                'protein' => $protein,
                'fat' => $fat,
                'sodium' => $sodium,
                'fiber' => $fiber,
            ]);

            if (!$store) {
                return  response()->json(false);
            }

            foreach ($request['ingredients'] as $key => $value) {
                $store->ingredient()->create([
                    'name' => $value['name'],
                    'instruction' => $value['instruction'],
                    'calories' => $value['calories'],
                    'carbohydrate' => $value['carbohydrate'],
                    'protein' => $value['protein'],
                    'fat' => $value['fat'],
                    'sodium' => $value['sodium'],
                    'fiber' => $value['fiber'],
                ]);
            }

            foreach ($request['instructions'] as $key => $value) {
                $store->procedure()->create([
                    'number' => $value['number'],
                    'description' => $value['description'],
                ]);
            }

            return  response()->json(true);
        } catch (Exception $e) {
            return  response()->json(false);
        }
    }
}
