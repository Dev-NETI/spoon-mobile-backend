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
        ]);

        try {
            $store = MealLogItem::create([
                'user_id' => $request['userId'],
                'meal_id' => $request['mealId'],
                'recipe_id' => $request['recipeId'],
                'number_of_serving' => $request['numberOfServings'],
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
            ->where('created_at', 'LIKE', '%' . $createdAt . '%')
            ->get();

        if (!$mealLogItemData) {
            return response()->json(false);
        }

        return response()->json($mealLogItemData);
    }
}
