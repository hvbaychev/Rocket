<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\University;
use App\Models\User;
use App\Models\CV;
use Illuminate\Http\Request;

class CvManagerController extends Controller
{
    public function index(){
        $users = User::all();
        $technologies = Technology::all();
        $universities = University::all();

        return view('admin.dashboard', compact('users', 'technologies', 'universities'));
    }


    public function cv(){
        $users = User::all();
        $technologies = Technology::all();
        $universities = University::all();
        return view('admin.searchBd', compact('users', 'technologies', 'universities'));
    }


    // public function searchCvByPeriod(Request $request)
    // {
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');


    //     $cvList = CV::whereBetween('birth_date', [$startDate, $endDate])->get();

    //     return view('admin.searchBd', compact('cvList'));
    // }


    public function searchCvByPeriod(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $cvList = CV::whereIn('id', function ($query) use ($startDate, $endDate) {
            $query->selectRaw('MIN(id)')
                ->from('cvs')
                ->whereBetween('birth_date', [$startDate, $endDate])
                ->groupBy('user_id');
        })
        ->get();

        return view('admin.searchBd', compact('cvList'));
    }

}
