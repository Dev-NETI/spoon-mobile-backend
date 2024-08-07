<?php

namespace App\Http\Controllers;

use App\Models\DietaryReferenceValue;
use Illuminate\Http\Request;

class DietaryReferenceValueController extends Controller
{
    public function index()
    {
        $appropriateDRIData = DietaryReferenceValue::where('id', 2)->first();
        if (!$appropriateDRIData) {
            return response()->json(false);
        }
        return response()->json($appropriateDRIData);
    }
}
