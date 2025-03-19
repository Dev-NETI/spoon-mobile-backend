<?php

namespace App\Http\Controllers;

use App\Models\Amr;
use Illuminate\Http\Request;

class AmrController extends Controller
{
    public function index()
    {
        try {
            $data = Amr::get();

            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
