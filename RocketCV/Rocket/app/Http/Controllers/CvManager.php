<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CV;
use App\Models\User;
use App\Models\University;
use App\Models\Technology;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CreateCvRequest;

class CvManager extends Controller
{
    public function index()
    {
        $users = User::all();
        $universities = University::all();
        $technologies = Technology::all();
        return view('cv', compact('users', 'universities', 'technologies'));
    }


    public function createCv(CreateCvRequest $request)
    {

        $newCV = new CV();
        $newCV->first_name = $request->input('first_name');
        $newCV->middle_name = $request->input('middle_name');
        $newCV->last_name = $request->input('last_name');
        $newCV->birth_date = $request->input('birth_date');
        $newCV->universities_id = $request->input('universities_id');
        $newCV->technologies_id = $request->input('technologies_id');
        $newCV->user_id = Session::get('loginId');

        $res =  $newCV->save();

        if ($res) {
            return response()->json(['success' => true]);
        }
    }

    public function createUni(Request $request)
    {
        $newUniversityName = $request->input('newUniversity');

        if (!empty($newUniversityName)) {
            $university = new University();
            $university->name = $newUniversityName;
            $university->save();

            return response()->json(['success' => true, 'message' => 'University created successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'University name is required']);
        }
    }

    public function createTech(Request $request)
    {
        $newTechnologyName = $request->input('newTechnology');

        if (!empty($newTechnologyName)) {
            $technology = new Technology();
            $technology->name = $newTechnologyName;
            $technology->save();

            return response()->json(['success' => true, 'message' => 'Technology created successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Technology name is required']);
        }
    }


}
