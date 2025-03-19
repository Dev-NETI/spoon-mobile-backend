<?php

namespace App\Http\Controllers;

use App\Models\BmiLog;
use Exception;
use Illuminate\Http\Request;

class BmiLogController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "userId" => "required",
            "bmi" => "required",
        ]);

        if ($request['bmi'] < 18.5) {
            $bmiCategoryId = 1;
        } else if ($request['bmi'] >= 18.5 && $request['bmi'] <= 24.9) {
            $bmiCategoryId = 2;
        } else if ($request['bmi'] >= 25 && $request['bmi'] <= 29.9) {
            $bmiCategoryId = 3;
        } else {
            $bmiCategoryId = 4;
        }

        try {
            $store = BmiLog::create([
                'user_id' => $request['userId'],
                'bmi' => $request['bmi'],
                'bmi_category_id' => $bmiCategoryId,
            ]);

            if (!$store) {
                return  response()->json(false);
            }

            return  response()->json(true);
        } catch (Exception $e) {
            return  response()->json(false);
        }
    }

    public function show($userId)
    {
        $bmiLogData = BmiLog::with(['bmi_category'])
            ->where('is_active', 1)
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($bmiLogData->isEmpty()) { // ✅ Proper way to check empty collection
            return response()->json([], 200); // ✅ Return empty array instead of `false`
        }

        return response()->json($bmiLogData, 200);
    }
}
