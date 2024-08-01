<?php

namespace App\Http\Controllers;

use App\Models\BloodPressureLog;
use Exception;
use Illuminate\Http\Request;

class BloodPressureLogController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "systolic" => "required|numeric",
            "diastolic" => "required|numeric",
            "userId" => "required",
        ]);

        try {
            $store = BloodPressureLog::create([
                'systolic' => $request['systolic'],
                'diastolic' => $request['diastolic'],
                'user_id' => $request['userId'],
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
        $bloodPressureLogData = BloodPressureLog::where('is_active', 1)
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        if (empty($bloodPressureLogData)) {
            return response()->json(false);
        }
        return response()->json($bloodPressureLogData);
    }
}
