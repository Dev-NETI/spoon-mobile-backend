<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use Illuminate\Http\Request;

class RankController extends Controller
{
    public function index()
    {
        return response()->json(Rank::where('is_active',1)->orderBy('name','asc')->get());
    }
}
