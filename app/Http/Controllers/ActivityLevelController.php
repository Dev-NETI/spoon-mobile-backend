<?php

namespace App\Http\Controllers;

use App\Models\ActivityLevel;
use Illuminate\Http\Request;

class ActivityLevelController extends Controller
{
    public function index()
    {
        $activityLevelData = ActivityLevel::where('id', '!=', 1)->orderBy('id', 'asc')->get();
        if (!$activityLevelData) {
            return response()->json(false);
        }
        return response()->json($activityLevelData);
    }
}
