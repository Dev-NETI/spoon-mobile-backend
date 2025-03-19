<?php

namespace App\Http\Controllers;

use App\Models\MealLogItem;
use Exception;
use Illuminate\Http\Request;

class MealLogItemController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "numberOfServings" => 'required|numeric|min:0',
            "mealId" => 'required',
            "userId" => 'required',
            "recipeId" => 'required',
            "date" => 'required|date',
        ]);

        try {
            $store = MealLogItem::create([
                'user_id' => $request['userId'],
                'meal_id' => $request['mealId'],
                'recipe_id' => $request['recipeId'],
                'number_of_serving' => $request['numberOfServings'],
                'date' => $request['date'],
            ]);

            if (!$store) {
                return response()->json(false, 400);
            }

            return response()->json(true, 200);
        } catch (Exception $e) {
            return response()->json(false, 400);
        }
    }

    public function show($userId, $createdAt)
    {
        $mealLogItemData = MealLogItem::with(['recipe'])
            ->where('user_id', $userId)
            ->where('date', $createdAt)
            ->get();

        if (!$mealLogItemData) {
            return response()->json(false);
        }

        return response()->json($mealLogItemData);
    }
    /**
     * Delete a meal log item based on recipe_id, created_at, meal_id, and user_id
     */
    public function deleteMealLogItem(Request $request)
    {
        $request->validate([
            'recipe_id'   => 'required|integer',
            'created_at'  => 'required|date',
            'meal_id'     => 'required|integer',
            'user_id'     => 'required|integer',
        ]);

        $deleted = MealLogItem::where('recipe_id', $request->recipe_id)
            ->where('user_id', $request->user_id)
            ->where('meal_id', $request->meal_id)
            ->where('date',  $request->created_at)
            ->delete();

        if ($deleted) {
            return response()->json(['success' => true, 'message' => 'Meal log item deleted successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'No matching meal log item found.'], 404);
    }
}
