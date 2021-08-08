<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContributorController extends Controller
{
    public function index()
    {   
        $users = User::where('user_type', '=', 1)->get();
        return view('backEnd.contributers.create', compact('users'));
    }

    public function getContributors()
    {
        $contributors = User::where('user_type', 1)->get();
        return response()->json($contributors);
    }

    public function approveContributor(Request $request)
    {
        $contributorId = $request["contributorId"];
        $contributor = User::find($contributorId);
        if($contributor){
            $updated = $contributor->update([
                'active_status' => 1
            ]);

            if($updated) {
                return response()->json(['status' => 200], 200);
            } else {
                return response()->json(['status' => 500], 500);
            }
        }

        return response()->json(['status' => 404], 404);
    }
}
