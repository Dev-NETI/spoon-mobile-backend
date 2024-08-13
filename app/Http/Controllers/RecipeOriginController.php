<?php

namespace App\Http\Controllers;

use App\Models\RecipeOrigin;
use Exception;
use Illuminate\Http\Request;

class RecipeOriginController extends Controller
{
    public function index()
    {
        try {
            $recipeOriginData = RecipeOrigin::where('is_active', 1)->orderBy('name', 'asc')->get();

            if (!$recipeOriginData) {
                return response()->json(false);
            }

            return response()->json($recipeOriginData);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }
}
