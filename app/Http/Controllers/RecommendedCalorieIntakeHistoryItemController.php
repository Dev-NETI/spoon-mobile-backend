<?php

namespace App\Http\Controllers;

use App\Models\RecommendedCalorieIntakeHistoryItem;
use Illuminate\Http\Request;

class RecommendedCalorieIntakeHistoryItemController extends Controller
{
    public function show($user)
    {
        $savedRecipes = RecommendedCalorieIntakeHistoryItem::where('user_id', $user)->where('is_active', 1)->orderBy('created_at', 'desc')->get();

        return response()->json($savedRecipes);
    }

    public function store(Request $request)
    {
        try {
            $store = RecommendedCalorieIntakeHistoryItem::create(
                [
                    'user_id' => $request['userid'],
                    'maintenance_calorie' => $request['maintenanceCalories'],
                    'mild_weight_loss' => $request['mildweightloss'],
                    'weight_loss' => $request['weightLoss'],
                    'extreme_weight_loss' => $request['extremeweightloss'],
                    'mild_weight_gain' => $request['mildweightgain'],
                    'weight_gain' => $request['weightgain'],
                    'extreme_weight_gain' => $request['extremeweightgain'],
                    'is_active' => 1,
                ]
            );

            return response()->json(true, 200);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }
}
