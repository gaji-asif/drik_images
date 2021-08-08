<?php

namespace App\Http\Controllers;

use App\Helpers\SearchImage;
use App\User;
use App\Category;
use App\ImageChild;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller {
    public function index($category) {
        $categories = Category::all();
        $photographers = User::where('user_type', 1)->get();
        $images = ImageChild::where('category', $category)->paginate(20);
        return view('filter', compact('images', 'categories', 'photographers'));
    }

    public function filterImage(Request $request) {
        $searchImage = new SearchImage();
        $images = $searchImage->searchImage($request);
        return response()->json(['images' => $images, 'status' => 200], 200);
    }
}
