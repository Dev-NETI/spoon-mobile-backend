<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function index()
    {
        $seasonData = Season::where('is_active',  1)->orderBy('name', 'asc')->get();
        if (!$seasonData) {
            return response()->json(false);
        }
        return response()->json($seasonData);
    }
}
