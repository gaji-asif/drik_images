<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\ErpPatient;
use App\ActivityLog;
use App\ErpHeader;
use App\ImageChild;
use App\PatientDocument;
use App\Purchase;
use DB;
use App\User;
use Auth;
use Illuminate\Support\Carbon;
use Session;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
//        $head = ErpHeader::find('1');
//        $header = $head->header;
//        $header_t = $head->header_title;
//        session()->flash('header', $header);
//        session()->flash('header_t', $header_t);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $users = User::all()->count();
        $contributors = User::where('user_type',1)->count();
        $totalPayment = Purchase::sum('total');
        $totalImages = ImageChild::where('is_portfolio',0)->count();

        return view('backEnd.dashboard', compact('users',"contributors","totalPayment",'totalImages'));
    }

     public function webIndex() {
            return "dadfad";
     }

    public function get_sub_categories(Request $request) {
        $categoryId = $request->categoryId;
        $categories = Category::where('parent_category_id', $categoryId)->get();
        return response()->json(["subCategories"=>$categories], 200);
    }

}
