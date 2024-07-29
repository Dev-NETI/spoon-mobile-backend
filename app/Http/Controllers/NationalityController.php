<?php

namespace App\Http\Controllers;

use App\Models\Nationality;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    public function index()
    {
        return response()->json(Nationality::where('is_active',1)->orderBy('name','asc')->get());
    }
}
