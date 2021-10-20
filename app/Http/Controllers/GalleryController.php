<?php

namespace App\Http\Controllers;
use App\Category;
use App\ImageChild;
use App\imageUsageCategorie;
use App\ImageUsageName;
use App\ImageUsagPrice;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PDF;
use Illuminate\Http\Request;
use function React\Promise\reduce;

class GalleryController extends Controller {
    public function index(Request $request) {
  
      
        $categories = Category::all();
        $images = ImageChild::with('categories','subCategories')->where('is_portfolio',0)->where('status',1)->paginate(30);

       
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
        $home = 'home';
        $imageUsageCategory = imageUsageCategorie::all();
        $currentPage = $images->currentPage();
        $lastPage = $images->lastPage();
        $nextPageUrl = $images->nextPageUrl();
        if($request->has('page'))
        {
            return view('image_gallary', compact('images','currentPage','lastPage','nextPageUrl', 'categories','imageUsageCategory','imageUsageNameMap', 'user', 'home'));
        }
        return view('new_welcome', compact('images','currentPage','lastPage','nextPageUrl', 'categories','imageUsageCategory','imageUsageNameMap', 'user', 'home'));
    }
    public function shareImage($id) {
       
        $categories = Category::all();
        $image = ImageChild::with('categories','subCategories')->where('id',$id)->where('is_portfolio',0)->where('status',1)->first();
        $imageUsageNames = ImageUsageName::all()->toArray();
        $imageUsageNameMap = $this->imageUsageNameMap($imageUsageNames);
        $usage_names_price = ImageUsagPrice::where('image_id', $image->id)->get();
        if(isset($usage_names_price))
        {
            $image->usage_names_price = $usage_names_price;
        }

        $user = Auth::user();
        $page = 'Share';
        if(is_null($image)) {
            return redirect('/');
        }
        $imageUsageCategory = imageUsageCategorie::all();
        return view('sharePage', compact('image','imageUsageNameMap','imageUsageCategory','categories', 'user', 'page'));
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

    public function imageDetails($id) {
        $image = ImageChild::where('id',$id)->with('categories','subCategories')->where('is_portfolio',0)->where('status',1)->first();

        $imageUsageNames = ImageUsageName::all()->toArray();
        $image->imageUsageNameMap = $this->imageUsageNameMap($imageUsageNames);

            $usage_names_price = ImageUsagPrice::where('image_id', $image->id)->get();
            if(isset($usage_names_price))
            {
                $image->usage_names_price = $usage_names_price;
            }
            else
            {
                $image->usage_names_price = [];
            }
       
        
        return response()->json(['data'=>$image], 200);
    }
  

}
