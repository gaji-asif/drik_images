<?php

namespace App\Http\Controllers;

use App\Helpers\SearchImage;
use App\User;
use App\Category;
use App\ImageChild;
use App\imageUsageCategorie;
use App\ImageUsageName;
use App\ImageUsagPrice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller {
    public function index($category) {
        $categories = Category::all();
        $photographers = User::where('user_type', 1)->get();
        $images = ImageChild::where('category', $category)->paginate(20);
        return view('filter', compact('images', 'categories', 'photographers'));
    }

    public function filterImage(Request $request) {
  
        $page = $request->input('page');
        // dump($page);
        $searchImage = new SearchImage();
        $categories = Category::all();
        $photographers = User::where('user_type', 1)->get();
        $images = $searchImage->searchImage($request);
        
        $categories = Category::all();
     
        $imageUsageNames = ImageUsageName::all()->toArray();
        $imageUsageNameMap = $this->imageUsageNameMap($imageUsageNames);
        foreach( $images as $image) {
            $usage_names_price = ImageUsagPrice::where('image_id', $image->id)->get();
            if(isset($usage_names_price))
            {
                $image->usage_names_price = $usage_names_price;
            }
            else
            {
                break;
            }
        }
        $user = Auth::user();
     
        $imageUsageCategory = imageUsageCategorie::all();

        $currentPage = $images->currentPage();
        $lastPage = $images->lastPage();
        $nextPageUrl = $images->nextPageUrl();

        if($request->ajax()) {
      
            return view('filter-inner-div', compact('images','currentPage','lastPage','nextPageUrl', 'categories','imageUsageCategory','imageUsageNameMap', 'user'));
        }
        return view('filter', compact('images', 'categories','currentPage','lastPage','nextPageUrl','imageUsageCategory','imageUsageNameMap', 'user'));
    }

    public function imageUsageNameMap($imageUsageNames)
    {
        $imageUsageNameArray = array();
        foreach($imageUsageNames as $item)
        {
            $imageUsageNameMap[$item['id']] = $item['name'];
        }
        return $imageUsageNameMap;
    }
}
