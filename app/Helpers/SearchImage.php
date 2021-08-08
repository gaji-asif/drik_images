<?php

namespace App\Helpers;

use App\Category;
use App\ImageChild;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SearchImage {
    public function searchImage($request)
    {
        $page = $request["page"];
        $previousPage = $page - 1;

        $search = $request->input('search_key');

        $searchKeyWords = explode(" ", $search);

        $searchKeyWords = array_filter($searchKeyWords, function($elm) {
            return strlen($elm) > 2;
        });

        foreach ($searchKeyWords as $value){
            if(!isset($searchQuery)) {
                $searchQuery = ImageChild::where('keywords', 'like', '%' . $value . '%');
            } else {
                $searchQuery = $searchQuery->orWhere('keywords', 'like', '%' . $value . '%');
            }
        };

        if($request["sorting"]) {
            if($request["sorting"] === "asc") {
                $searchQuery = $searchQuery->orderBy('id', 'asc');
            } else {
                $searchQuery = $searchQuery->orderBy('id', 'desc');
            }
        } else {
            $searchQuery = $searchQuery->orderBy('id', 'desc');
        }

        if($request["time"]) {
            $searchQuery = $searchQuery->where('created_at', '>=', Carbon::now()->subDay($request["time"]));
        }

        if($request["photographer"]) {
            $photographerName = $request["photographer"];
            $photographer = User::where('name', $photographerName)->first();
            if($photographer) {
                $searchQuery = $searchQuery->where('user_id', $photographer->id);
            } else {
                $searchQuery = $searchQuery->where('user_id', 0);
            }
        }

        if($request["orientation"]) {
            $searchQuery = $searchQuery->where('orientation', $request["orientation"]);
        }

        if($request["people"])
        {
            $searchQuery = $searchQuery->where('no_people', $request["people"]);
        }

        if($request["composition"])
        {
            $searchQuery = $searchQuery->where('people_composition', $request["composition"]);
        }

        return $searchQuery->skip($previousPage * 1)->take(1)->paginate(20);
    }
}
