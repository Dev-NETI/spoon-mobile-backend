<?php

namespace App\Http\Controllers;

use App\Http\Resources\TopRecipeResource;
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

    public function topRecipe()
    {

        $recipeData = TopRecipeResource::collection(
            Recipe::with(['recipe_origin', 'meal_type', 'season_list_item.season', 'recipe_review'])
                ->where('is_active', 1)
                ->whereHas('recipe_review')
                ->withCount('recipe_review')
                ->orderBy('recipe_review_count', 'desc')
                ->orderBy('name', 'asc')
                ->limit(5)
                ->get()
        );

        if (!$recipeData) {
            return response()->json(false);
        }

        return response()->json($recipeData);
    }

    public function show($slug)
    {
        try {
            $recipe = Recipe::with([
                'meal_type',
                'recipe_origin',
                'food_group_list_item.food_group',
                'season_list_item.season',
                'ingredient',
                'ingredient.unit',
                'procedure',
                'recipe_review',
                'recipe_review.user',
            ])->where('slug', $slug)->firstOrFail();

            return response()->json($recipe);
        } catch (Exception $e) {
            return response()->json(['error' => 'Recipe not found'], 404);
        }
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

    public function filteredRecipe(Request $request) {}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'meal_type_id' => 'required|integer|min:1',
            'number_of_serving' => 'required|integer|min:1',
            'recipe_origin_id' => 'required|integer|min:1',
            'breakfast' => 'nullable|integer',
            'lunch' => 'nullable|integer',
            'snack' => 'nullable|integer',
            'dinner' => 'nullable|integer',
            'ingredients' => 'required|array',
            'ingredients.*.name' => 'required|string',
            'ingredients.*.instruction' => 'required|string',
            'ingredients.*.unit_id' => 'required|integer|min:1',
            'ingredients.*.quantity' => 'required|integer|min:1',
            'ingredients.*.calories' => 'nullable|integer',
            'ingredients.*.carbohydrate' => 'nullable|integer',
            'ingredients.*.protein' => 'nullable|integer',
            'ingredients.*.fat' => 'nullable|integer',
            'ingredients.*.sodium' => 'nullable|integer',
            'ingredients.*.fiber' => 'nullable|integer',
            'instructions' => 'required|array',
            'instructions.*.number' => 'required|integer',
            'instructions.*.description' => 'required|string',
            'image_path' => 'nullable',
        ]);

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
                'name' => $request['name'],
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
                'image_path' => $request['image_path'], // Make sure this line is present
            ]);

            if (!$store) {
                return  response()->json(false);
            }

            foreach ($request['ingredients'] as $key => $value) {
                $store->ingredient()->create([
                    'name' => $value['name'],
                    'instruction' => $value['instruction'],
                    'quantity' => $value['quantity'],
                    'unit_id' => $value['unit_id'],
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

            return  response()->json(true, 200);
        } catch (Exception $e) {
            return  response()->json(false, 500);
        }
    }

    public function update(Request $request, $slug)
    {
        try {
            $recipe = Recipe::where('slug', $slug)->firstOrFail();

            // Validate the request data
            $validatedData =  $request->validate([
                'name' => 'required|string|min:2',
                'meal_type_id' => 'required|integer|min:1',
                'number_of_serving' => 'required|integer|min:1',
                'recipe_origin_id' => 'required|integer|min:1',
                'breakfast' => 'nullable|integer',
                'lunch' => 'nullable|integer',
                'snack' => 'nullable|integer',
                'dinner' => 'nullable|integer',
                'ingredients' => 'required|array',
                'ingredients.*.name' => 'required|string',
                'ingredients.*.instruction' => 'required|string',
                'ingredients.*.unit_id' => 'required|integer|min:1',
                'ingredients.*.quantity' => 'required|integer|min:1',
                'ingredients.*.calories' => 'nullable|integer',
                'ingredients.*.carbohydrate' => 'nullable|integer',
                'ingredients.*.protein' => 'nullable|integer',
                'ingredients.*.fat' => 'nullable|integer',
                'ingredients.*.sodium' => 'nullable|integer',
                'ingredients.*.fiber' => 'nullable|integer',
                'instructions' => 'required|array',
                'instructions.*.number' => 'required|integer',
                'instructions.*.description' => 'required|string',
                'image_path' => 'nullable',
            ]);

            // Update the recipe
            $recipe->update($validatedData);

            // Calculate total nutritional values
            $totalCalories = 0;
            $totalCarbohydrate = 0;
            $totalProtein = 0;
            $totalFat = 0;
            $totalSodium = 0;
            $totalFiber = 0;

            // Update or create ingredients
            $recipe->ingredient()->delete();
            foreach ($validatedData['ingredients'] as $ingredientData) {
                $recipe->ingredient()->create($ingredientData);

                // Sum up nutritional values
                $totalCalories += $ingredientData['calories'];
                $totalCarbohydrate += $ingredientData['carbohydrate'];
                $totalProtein += $ingredientData['protein'];
                $totalFat += $ingredientData['fat'];
                $totalSodium += $ingredientData['sodium'];
                $totalFiber += $ingredientData['fiber'];
            }

            // Update recipe with total nutritional values
            $recipe->update([
                'calories' => $totalCalories,
                'carbohydrate' => $totalCarbohydrate,
                'protein' => $totalProtein,
                'fat' => $totalFat,
                'sodium' => $totalSodium,
                'fiber' => $totalFiber,
            ]);

            // Update or create instructions
            $recipe->procedure()->delete();
            foreach ($validatedData['instructions'] as $instructionData) {
                $recipe->procedure()->create($instructionData);
            }

            return response()->json($recipe->load(['meal_type', 'recipe_origin', 'ingredient', 'procedure']));
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($slug)
    {
        try {
            $recipe = Recipe::where('slug', $slug)->firstOrFail();
            $recipe->is_active = 0;
            $recipe->save();
            return response()->json(true);
        } catch (Exception $e) {
            return response()->json(false);
        }
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

    public function ActivateRecipe($slug)
    {
        try {
            $recipe = Recipe::where('slug', $slug)->firstOrFail();
            $recipe->is_active = 1;
            $recipe->save();
            return response()->json(['message' => 'Recipe activated successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to activate recipe'], 500);
        }
    }
}
