<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // $request->validate([
        //     'firstname' => 'required|string|max:255',
        //     'lastname' => 'required|string|max:255',
        //     'dateOfBirth' => 'required|date',
        //     'age' => 'required|integer|min:0',
        //     'nationality' => 'required',
        //     'heightImperial' => 'required',
        //     'heightMetric' => 'required',
        //     'weightImperial' => 'required',
        //     'weightMetric' => 'required',
        //     'company' => 'required',
        //     'category' => 'required',
        //     'rank' => 'required',
        //     'email' => 'required|email|unique:users,email', 
        //     'password' => [
        //                             'required',
        //                             'string',
        //                             'min:8',
        //                             'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
        //             ],
        // ]);

        try {
            $store = User::create([
                'firstname' => $request['firstname'],
                'middlename' => $request['middlename'],
                'lastname' => $request['lastname'],
                'suffix' => $request['suffix'],
                'date_of_birth' => $request['dateOfBirth'],
                'age' => $request['age'],
                'nationality_id' => $request['nationality'],
                'height_imperial' => $request['heightImperial'],
                'height_metric' => $request['heightMetric'],
                'weight_imperial' => $request['weightImperial'],
                'weight_metric' => $request['weightMetric'],
                'company' => $request['company'],
                'category_id' => $request['category'],
                'rank_id' => $request['rank'],
                'email' => $request['email'],
                'password' => Hash::make($request['confirmPassword']),
            ]);

            if(!$store){
                return  response()->json(false);
            }

            return  response()->json(true);
        } catch (Exception $e) {
            return  response()->json(false);
        }

    }
}
