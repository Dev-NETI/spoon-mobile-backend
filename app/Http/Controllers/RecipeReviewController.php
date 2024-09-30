<?php

namespace App\Http\Controllers;

use App\Models\RecipeReview;
use Exception;
use Illuminate\Http\Request;

class RecipeReviewController extends Controller
{
    
    public function store(Request $request)
    {
        $request->validate([
            "review" => 'required',
            "rating" => 'required',
            "recipeId" => 'required',
            "userId" => 'required',

        ]);

        try {
            $store = RecipeReview::create([
                'recipe_id' => $request['recipeId'],
                'user_id' => $request['userId'],
                'rating' => $request['rating'],
                'comment' => $request['review'],
            ]);

            if (!$store) {
                return response()->json(false);
            }

            return response()->json(true);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }
    
    public function show($recipeId)
    {
        try {
            $reviewData = RecipeReview::with('user')
                ->where('recipe_id', $recipeId)
                ->where('is_active', 1)
                ->orderBy('created_at', 'DESC')
                ->get();

            if (!$reviewData) {
                return response()->json(false);
            }

            return response()->json($reviewData);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }

    
    
}
