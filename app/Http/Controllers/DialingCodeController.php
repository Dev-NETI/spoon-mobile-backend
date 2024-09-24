<?php

namespace App\Http\Controllers;

use App\Models\DialingCode;
use Illuminate\Http\Request;

class DialingCodeController extends Controller
{
    public function index()
    {
        $dialingCodeData = DialingCode::orderBy('country_code','asc')->get();

        if(!$dialingCodeData){
            return response()->json(false);
        }
        return response()->json($dialingCodeData);
    }
}
