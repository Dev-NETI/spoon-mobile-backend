<?php

namespace App\Http\Controllers;

use App\Models\DialingCode;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function showAll()
    {
        $userData = User::orderBy('created_at', 'desc')->get();
        if (!$userData) {
            return response()->json(false);
        }
        return response()->json($userData);
    }

    public function show($slug)
    {
        $userData = User::where('slug', $slug)->first();
        if (!$userData) {
            return response()->json(false);
        }
        return response()->json($userData);
    }

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
                'dialing_code_id' => $request['dialingCodeId'],
                'contact_number' => $request['contactNum'],
                'password' => Hash::make($request['confirmPassword']),
            ]);

            if (!$store) {
                return  response()->json(false);
            }

            return  response()->json(true);
        } catch (Exception $e) {
            return  response()->json(false);
        }
    }

    public function updateMeasurement($slug, Request $request)
    {
        $request->validate([
            'heightImperial' => 'required',
            'heightMetric' => 'required',
            'weightImperial' => 'required',
            'weightMetric' => 'required',
        ]);

        try {
            $userData = User::where('slug', $slug)->first();

            if (!$userData) {
                return  response()->json(false);
            }

            $update = $userData->update([
                'height_imperial' => $request['heightImperial'],
                'height_metric' => $request['heightMetric'],
                'weight_imperial' => $request['weightImperial'],
                'weight_metric' => $request['weightMetric'],
            ]);

            if (!$update) {
                return  response()->json(false);
            }

            return  response()->json(true);
        } catch (Exception $e) {
            return  response()->json(false);
        }
    }

    public function updateDataForEnergyComputation($slug, Request $request)
    {
        $request->validate([
            'heightStandard' => 'required|numeric',
            'heightMetric' => 'required|numeric',
            'weightStandard' => 'required|numeric',
            'weightMetric' => 'required|numeric',
            'dateOfBirth' => 'required|date',
            'age' => 'required|integer|min:0',
            'gender' => 'required|integer',
            'activityLevel' => 'required|integer',
        ]);


        try {
            $userData = User::where('slug', $slug)->first();

            if (!$userData) {
                return  response()->json(false);
            }

            $update = $userData->update([
                'height_imperial' => $request['heightStandard'],
                'height_metric' => $request['heightMetric'],
                'weight_imperial' => $request['weightStandard'],
                'weight_metric' => $request['weightMetric'],
                'date_of_birth' => $request['dateOfBirth'],
                'age' => $request['age'],
                'gender_id' => $request['gender'],
                'activity_level_id' => $request['activityLevel'],
            ]);

            if (!$update) {
                return  response()->json(false);
            }

            return  response()->json(true);
        } catch (Exception $e) {
            return  response()->json(false);
        }
    }

    public function updateCalorieIntake($slug, Request $request)
    {
        $request->validate([
            'radioCalorieGoal' => 'required',
        ]);


        try {
            $userData = User::where('slug', $slug)->first();

            if (!$userData) {
                return  response()->json(false);
            }

            $update = $userData->update([
                'calorie_intake' => $request['radioCalorieGoal'],
            ]);

            if (!$update) {
                return  response()->json(false);
            }

            return  response()->json(true);
        } catch (Exception $e) {
            return  response()->json(false);
        }
    }

    public function updateFirstLogin($slug)
    {
        try {
            $userData = User::where('slug', $slug)->first();

            if (!$userData) {
                return  response()->json(false);
            }

            $update = $userData->update([
                'is_first_login' => 0,
            ]);

            if (!$update) {
                return  response()->json(false);
            }

            return  response()->json(true);
        } catch (Exception $e) {
            return  response()->json(false);
        }
    }

    public function updateBasicInformation($slug, Request $request)
    {
        $request->validate([
            "firstname" =>  "required|string|max:255",
            "middlename" =>  "nullable|string|max:255",
            "lastname" =>  "required|string|max:255",
            "email" =>  "required|email|max:255",
        ]);

        try {
            $userData = User::where('slug', $slug)->first();

            if (!$userData) {
                return response()->json(false);
            }

            $update = $userData->update([
                'firstname' => $request['firstname'],
                'middlename' => $request['middlename'],
                'lastname' => $request['lastname'],
                'suffix' => $request['suffix'],
                'email' => $request['email'],
            ]);

            if (!$update) {
                return response()->json(false);
            }

            return response()->json(true);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }

    public function updatePassword($slug, Request $request)
    {
        $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'max:255',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&#]/'
            ],
        ]);

        try {
            $userData = User::where('slug', $slug)->first();

            if (!$userData) {
                return response()->json(false);
            }

            $update = $userData->update([
                'password' => Hash::make($request['password']),
            ]);

            if (!$update) {
                return response()->json(false);
            }

            return response()->json(true);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }

    public function updatePersonalInformation($slug, Request $request)
    {
        $request->validate([
            "firstname" =>  "required|string|max:255",
            "middlename" =>  "nullable|string|max:255",
            "lastname" =>  "required|string|max:255",
            "company" => 'required',
            "rank" => 'required',
            "category" => 'required',
            "nationality" => 'required',
            "gender" => 'required',
        ]);

        try {
            $userData = User::where('slug', $slug)->first();

            if (!$userData) {
                return response()->json(false);
            }

            $update = $userData->update([
                'firstname' => $request['firstname'],
                'middlename' => $request['middlename'],
                'lastname' => $request['lastname'],
                'suffix' => $request['suffix'],
                'company' => $request['company'],
                'rank_id' => $request['rank'],
                'category_id' => $request['category'],
                'nationality_id' => $request['nationality'],
                'gender_i' => $request['gender'],
            ]);

            if (!$update) {
                return response()->json(false);
            }

            return response()->json(true);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }

    public function checkContactNumber($contactNumber,$dialingCode = null)
    {
        try {
            $contactNumberData = User::where('contact_number',$contactNumber)->first();
            $dialingCodeData = DialingCode::where('id', $dialingCode)->first();
            Session::put('dialingCodeId', $dialingCodeData->id);
            Session::put('dialingCode', $dialingCodeData->dialing_code);

            if(!$contactNumberData){
                Session::put('contactNum', $contactNumber);
                return response()->json(false);
            }

            return response()->json(true);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }
}
