<?php

namespace App\Http\Controllers;

use App\Models\BmiLog;
use App\Models\RecipeReview;
use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showBmiAnalytics($weightClass = 1, $userTypeId = 1 , $companyId = 73)//weightClass 1 = underweight, 2 = overweight, 3 = obese
    {
        try {
            $alreadyFetchedUserIds = [];
            
            $query = BmiLog::with('user')
                ->where('is_active', 1)
                ->whereNotIn('user_id', $alreadyFetchedUserIds); 
                
            switch ($weightClass) {
                case 1:
                    $query->where('bmi', '<', 18.5)
                          ->orderBy('bmi', 'asc');
                    break;
                case 2:
                    $query->where('bmi', '>', 24)
                          ->where('bmi', '<', 30)
                          ->orderBy('bmi', 'desc');
                    break;
                default:
                    $query->where('bmi', '>=', 30)
                          ->orderBy('bmi', 'desc');
                    break;
            }

            if($userTypeId == 2 || $userTypeId == 1){
                $query->whereHas('user', function($subQuery) use ($companyId){
                    $subQuery->where('company',$companyId);
                });
            }

            $bmiData = $query->distinct('user_id') 
                ->limit(20)
                ->get();
                
            if ($bmiData->isEmpty()) {
                return response()->json(false);
            }
        
            return response()->json($bmiData);
        } catch (Exception $e) {
            return response()->json(false);
        }
        
    }

    public function showTopTenRatedRecipe()
    {
        
                    try {
                        $topRecipes = RecipeReview::select('recipe_id')
                                        ->selectRaw('AVG(rating) as average_rating')
                                        ->groupBy('recipe_id')
                                        ->orderByDesc('average_rating')
                                        ->limit(10)
                                        ->with(['recipe'])
                                        ->get();
            
                        if (!$topRecipes) {
                            return response()->json(false);
                        }
            
                        return response()->json($topRecipes);
                    } catch (Exception $e) {
                        return response()->json(false);
                    }
    }

}
