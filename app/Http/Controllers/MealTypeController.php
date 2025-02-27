<?php

namespace App\Http\Controllers;

use App\Models\MealType;
use Exception;
use Illuminate\Http\Request;

class MealTypeController extends Controller
{
    public function index()
    {
        $mealTypeData = MealType::where('is_active',  1)->orderBy('name', 'asc')->get();
        if (!$mealTypeData) {
            return response()->json(false);
        }
        return response()->json($mealTypeData);
    }

    public function AllMealType()
    {
        $mealTypeData = MealType::orderBy('name', 'asc')->get();
        if (!$mealTypeData) {
            return response()->json(false);
        }
        return response()->json($mealTypeData);
    }

    public function store(Request $request)
    {

        try {
            $store = MealType::create([
                'name' => $request->name,
                'is_active' => 1,
            ]);

            if (!$store) {
                return response()->json(false, 500);
            }

            return response()->json(true, 200);
        } catch (Exception $e) {
            return response()->json(false, 500);
        }
    }

    public function fetch(Request $request)
    {
        $ids = $request->input('ids');
        if (is_string($ids)) {
            $ids = explode(',', $ids);
        }

        $mealTypes = MealType::whereIn('id', $ids)->where('is_active', 1)->get();

        return response()->json($mealTypes);
    }

    public function show($slug)
    {
        try {
            $mealType = MealType::where('slug', $slug)->firstOrFail();
            if (!$mealType) {
                return response()->json(false, 404);
            }
            return response()->json($mealType, 200);
        } catch (Exception $e) {
            return response()->json(false, 404);
        }
    }

    public function update(Request $request, $slug)
    {
        try {
            $mealType = MealType::where('slug', $slug)->firstOrFail();
            if (!$mealType) {
                return response()->json(false, 404);
            }

            $mealType->update([
                'name' => $request->name,
            ]);

            return response()->json(true, 200);
        } catch (Exception $e) {
            return response()->json(false, 500);
        }
    }

    public function destroy($slug)
    {
        try {
            $mealType = MealType::where('slug', $slug)->firstOrFail();
            if (!$mealType) {
                return response()->json(false, 404);
            }
            $mealType->is_active = 0;
            $mealType->save();
            return response()->json(true, 200);
        } catch (Exception $e) {
            return response()->json(false, 500);
        }
    }

    public function ActivateMealType($slug)
    {
        try {
            $mealType = MealType::where('slug', $slug)->firstOrFail();
            if (!$mealType) {
                return response()->json(false, 404);
            }
            $mealType->is_active = 1;
            $mealType->save();
            return response()->json(true, 200);
        } catch (Exception $e) {
            return response()->json(false, 500);
        }
    }
}
