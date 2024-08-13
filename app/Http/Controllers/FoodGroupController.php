<?php

namespace App\Http\Controllers;

use App\Models\FoodGroup;
use Exception;
use Illuminate\Http\Request;

class FoodGroupController extends Controller
{
    public function index()
    {
        try {
            $foodGroupData = FoodGroup::where('is_active', 1)->orderBy('name', 'asc')->get();

            if (!$foodGroupData) {
                return response()->json(false);
            }

            return response()->json($foodGroupData);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }
}
