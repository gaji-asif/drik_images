<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\ErpPatient;
use App\ActivityLog;
use App\ErpHeader;
use App\PatientDocument;
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

        // echo "sss"; exit;
        $Patient = ErpPatient::where('active_status', '=', 1)->get();
        $Document = PatientDocument::all();

        $users = User::all();
        $userss = User::where('id', auth::user()->id)->first();
        Session::put('users_img', $userss->upload_img);
        $logs = "";
        $dateS = Carbon::now()->subMonth(1);
        $dateE = Carbon::now();
        if(Auth::user()->getRoleNames()->first() == 'Adminstrator'){
            $logs = ActivityLog::whereBetween('created_at',[$dateS,$dateE])->orderBy('created_at', 'desc')->get();
        }
        else
        {
            $id = auth::user()->id;
            $logs = ActivityLog::whereBetween('created_at',[$dateS,$dateE])->where('user_id',$id)->get();
        }

        $dashboard = ErpHeader::find('1');

        return view('backEnd.dashboard', compact('userss', 'Patient', 'logs', 'Document','dashboard'));
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
