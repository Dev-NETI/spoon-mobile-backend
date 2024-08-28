<?php

namespace App\Http\Controllers;

use App\Models\RecipeReview;
use Exception;
use Illuminate\Http\Request;

class RecipeReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
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

    // /**
    //  * Display the specified resource.
    //  */
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

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }
}
