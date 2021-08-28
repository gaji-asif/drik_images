<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\ImageChild;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Svg\Tag\Image;
use App\Category;
use App\Promocode;
use App\Purchase;
use App\PurchaseDetail;
use App\User;
use Illuminate\Support\Facades\Hash;
use Session;
use DataTables;
use Illuminate\Support\Facades\Config;
use PhpParser\Node\Expr\FuncCall;

class CustomerController extends Controller {
    public function index() {
          if(!Auth::check() || !(Auth::user()->user_type == 1 || Auth::user()->user_type == 2)) {
            return redirect()->route('user-login');
        }
        $categories = Category::all();
        $images = ImageChild::all();
        $user = Auth::user();

        $allUploadProtofolios = ImageChild::where('user_id',$user->id)->where('is_portfolio',1)->get();
        $allUpload= ImageChild::where('user_id',$user->id)->where('is_portfolio',0)->get();

        $purchase = Purchase::where('user_id', $user->id)->where('payment_status','Processing')->Orwhere('payment_status','Complete')->get(); 
       
        $purchaseIds = [];
        foreach ($purchase as $purchase_detail_id) {
            array_push($purchaseIds, $purchase_detail_id->id);
        }
        $purchaseItem = PurchaseDetail::whereIn('purchase_id', $purchaseIds)->orderBy('id', 'DESC')->where('status',1)->get(); 


        if(is_null($user)) {
            return redirect()->route('user-login');
        }

        if($user->user_type == 1){//contributors
            return view('web.contributors.dashboard', compact('images', 'categories', 'user','allUploadProtofolios','allUpload'));
        }else{
            return view('web.customers.dashboard', compact('images', 'categories', 'user','purchase' ,'purchaseItem'));
        }
    }
    
    public function allPurchase(){
        $categories = Category::all();
        $images = ImageChild::all();
        $id = Auth::user()->id;
        $user = user::find($id);
        $purcharse = Purchase::where('user_id', $id)->get();
        return view('web.customers.all_purchase',compact('images', 'categories', 'user','purcharse'));
    }

    public function getPurchasedInfo(Request $request)
    {
        $user = Auth::user();

        $data = Purchase::where('user_id', $user->id)->orderBy('id', 'DESC')->get(); 
     
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('payment_status', function($data) {
                $status = '';
                if ($data->payment_status == 'Processing' || $data->payment_status == 'Complete') {
                    $status = '<span class="badge badge-success p-2">'.$data->payment_status.'</span>';
                } 
                elseif($data->payment_status == 'Pending') {
                    $status = '<span class="badge badge-warning p-2">'.$data->payment_status.'</span>';
                }
                elseif($data->payment_status == 'Failed'  || $data->payment_status == 'Canceled' )
                {
                    $status = '<span class="badge badge-danger p-2">'.$data->payment_status.'</span>';
                }
                return $status;
            })
            ->addColumn('total', function($data) {
                $total = '<span >'.Config::get('app.curreny')." ".number_format((float) $data->total, 2, '.', '').'</span>';
                return $total;
            })
            ->addColumn('action', function($data){
                $actionBtn = '<a href="'.url('all-purchase-images/'.$data->id).'" class="btn btn-success btn-sm ">View</a> <a href="'.url('preview-invoice/'.$data->id).'" class="btn btn-info btn-sm "">Invoice</a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'payment_status','total'])
            ->make(true);
    }

    public function profile(){

        if(!Auth::check()){
            return redirect('/');
        }
        $categories = Category::all();
        $images = ImageChild::all();
        $id = Auth::user()->id;
        $user = user::find($id);

        return view('web.customers.profile',compact('images', 'categories', 'user'));
    }

    public function edit_profile(Request $request){

        $id = Auth::user()->id;
        $userss = User::where('id', Auth::user()->id)->first();
        if(empty($request->get('password'))){
            $password = $userss->password;
        } else{
            $password = Hash::make( $request->get('password') );
        }

        $user = User::find($id);
        $user->company_name = $request->get('company_name');
        $user->job_title = $request->get('job_title');
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = $password;

        if ($request->hasFile('upload_img')) {
            $upload = $request->file('upload_img');
            $file_type = $upload->getClientOriginalExtension();
            $upload_name =  time() . $upload->getClientOriginalName();
            $destinationPath = public_path('uploads/user_img');
            $upload->move($destinationPath, $upload_name);
            $user->upload_img = 'public/uploads/user_img/'.$upload_name;
        }

        $result = $user->update();
        if($result){
        //$userss = User::where('id', Auth::user()->id)->first();
        Session::put('users_img', $userss->upload_img);
        }

        return redirect()->back()->with('message-success', 'Profile has been updated');
    }

    public function wishlist() {
        $categories = Category::all();
        $images = ImageChild::all();
        $user = Auth::user();
        $favorites = DB::table('favorites')
                    ->leftjoin('all_images_childs', 'all_images_childs.id', '=', 'favorites.image_id')
                    ->select('favorites.*', 'all_images_childs.image_name', 'all_images_childs.small_url', 'all_images_childs.small_price')
                    ->where('favorites.user_id', $user->id)
                    ->get();
        return view('web.customers.wishlist', compact('images', 'categories', 'user', 'favorites'));
    }

    public function upload()
    {
        $user = Auth::user();
        $categories = Category::where('parent_category_id', null)->get();
        return view('web.contributors.upload', compact('categories', 'user'));
    }
    

    public function promocode() {
        $categories = Category::all();
        $images = ImageChild::all();
        $user = Auth::user();
        $promocode = DB::table('promocodes')->get();
        return view('web.customers.promocode', compact('images', 'categories', 'user', 'promocode'));
    }

    public function previewInvoice($id)
    {
        $categories = Category::all();
        $page = 'Invoice';
        $purchase = Purchase::where('id',$id)->with('purchase_details')->first();
        $promocode = Promocode::where('promocode',$purchase->promo_code)->first();
        if(isset($promocode)){
            $purchase->promocode_amount = $promocode->amount; 
        }
        else
        {
            $purchase->promocode_amount = ''; 
        }
      

        foreach ($purchase->purchase_details as $purchase_detail) {
            $imageChild = ImageChild::where('id', $purchase_detail->image_id)->first();   
            $purchase_detail->thumbnail = $imageChild->thumbnail_url; 
            $purchase_detail->author = $imageChild->author; 
            $purchase_detail->title = $imageChild->title; 
        
        }
        $user = User::find($purchase->user_id);

        return view('web.invoice.preview ', compact('purchase','user'));
    }

    public function allPurchaseImages($id)
    {
        

        $categories = Category::all();
        $images = ImageChild::all();
        $userId = Auth::user()->id;
        $user = user::find($userId);
        if($id == 0)
        {
            $purchase = Purchase::where('user_id', $user->id)->get(); 
            $purchaseIds = [];
            foreach ($purchase as $purchase_detail_id) {
                array_push($purchaseIds, $purchase_detail_id->id);
            }
            $purchaseDetail = PurchaseDetail::whereIn('purchase_id', $purchaseIds)->where('status',1)->get(); 
        }
        else
        {
            $purchaseDetail = PurchaseDetail::where('purchase_id', $id)->where('status',1)->get(); 
        }
        return view('web.customers.all_purchase_images',compact('images','id','purchaseDetail', 'categories', 'user'));
    }

    public function allPurchasedList($id)
    {
        $user = Auth::user();

        if($id == 0)
        {
            $purchase = Purchase::where('user_id', $user->id)->get(); 
            $purchaseIds = [];
            foreach ($purchase as $purchase_detail_id) {
                array_push($purchaseIds, $purchase_detail_id->id);
            }
            $data = PurchaseDetail::whereIn('purchase_id', $purchaseIds)->orderBy('id', 'DESC')->where('status',1)->get(); 
        }
        else
        {
            $data = PurchaseDetail::where('purchase_id', $id)->orderBy('id', 'DESC')->where('status',1)->get(); 
        }

        if(!is_null($data))
        {
            foreach ($data as $detail) {
                $imageChild = ImageChild::where('id', $detail->image_id)->first();
                $detail->title = $imageChild->title;
                $detail->thumbnail_url = $imageChild->thumbnail_url;
                $detail->image_main_url = $imageChild->image_main_url;
            }
        }
        
    
    
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('price', function($data) {
                $price = '<span >'.Config::get('app.curreny')." ".number_format((float) $data->price, 2, '.', '').'</span>';
                return $price;
            })
           ->addColumn('image', function($data) {
                $image =  '<div class="theBox"><img src="'.$data->thumbnail_url.'" alt=""></div>';
                return $image;
            })
            ->addColumn('action', function($data){
                $actionBtn = '<a href="'.$data->image_main_url.'" download class="btn btn-success btn-sm ">Download</a>';
                return $actionBtn;
            })
            ->rawColumns(['action','image','price'])
            ->make(true);
    }

    public function uploadedImages(Request $request)
    {

        $user = Auth::user();
        $categories = Category::all();
        $images = ImageChild::where('user_id',Auth::user()->id)->with('categories','subCategories')->orderBy('id', 'DESC')->where('is_portfolio',0)->get();
       
        $contributor_images = [];
        $total_sold_images = [];
        foreach ($images as $key => $value) {
            $contributor_images[] = $value['id'];
            $total_sold_images[$value['id']] = 0;
        }
  
        $soldImages = PurchaseDetail::whereIn('image_id',$contributor_images)->where('status',1)->get();
        
     
        foreach ($soldImages as $key => $value) {
            if(isset($total_sold_images[$value->image_id]))
            {
                $total_sold_images[$value->image_id] ++;
            }
        }
      
        // dd($images);
        if ($request->ajax()) {
            return view('web.contributors.all_image_inner_div', compact('images','total_sold_images'));
        }
        return view('web.contributors.uploaded_images', compact('images','categories','user','total_sold_images'));


    }
    public function uploadedProtfolioImages()
    {

        $user = Auth::user();
        $categories = Category::all();
        $images = ImageChild::where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->where('is_portfolio',1)->get();
     

        return view('web.contributors.uploaded_protfolio_images', compact('images','categories','user'));


    }

    public function getSoldImages(Request $request)
    {
        $images = ImageChild::where('user_id',Auth::user()->id)->where('is_portfolio',0)->where('status',1)->get('id')->toArray();
        $contributor_images = [];
            foreach ($images as $key => $value) {
                $contributor_images[] = $value['id'];
        }
        $soldImages = PurchaseDetail::whereIn('image_id',$contributor_images)->where('status',1)->get();

        $sold_images = [];
        foreach ($soldImages as $key => $value) {
            $sold_images[] = $value->image_id;
        }

        $user = Auth::user();
        $categories = Category::all();
        $images = ImageChild::whereIn('id',$sold_images)->with('categories','subCategories')->orderBy('id', 'DESC')->where('is_portfolio',0)->get();

        return view('web.contributors.all_image_inner_div_sold', compact('images','categories','user'));
      
    }

    public function getSoldImagesByDate(Request $request)
    {
        $images = ImageChild::where('user_id',Auth::user()->id)->where('is_portfolio',0)->where('status',1)->get('id')->toArray();
        $contributor_images = [];
            foreach ($images as $key => $value) {
                $contributor_images[] = $value['id'];
        }
        $from = $request->input('date_from');
        if(empty($from))
        {
            $from = date('Y-m-d');
        }
        else
        {
            $from = date('Y-m-d', strtotime($from));
        }
        $to = $request->input('date_to');
        if(empty($to))
        {
            $to = date('Y-m-d');
        }
        else
        {
            $to = date('Y-m-d', strtotime($to));
        }
        $soldImages = PurchaseDetail::whereIn('image_id',$contributor_images)->whereBetween('created_at', [$from, $to])->where('status',1)->get();

        $sold_images = [];
        foreach ($soldImages as $key => $value) {
            $sold_images[] = $value->image_id;
        }

        $user = Auth::user();
        $categories = Category::all();
        $images = ImageChild::whereIn('id',$sold_images)->with('categories','subCategories')->orderBy('id', 'DESC')->where('is_portfolio',0)->get();

        return view('web.contributors.all_image_inner_div_sold', compact('images','categories','user'));
    }

    public function contributorContact()
    {
        $categories = Category::all();        
        $user = Auth::user();
        return view('web.contributors.contact',compact('categories','user'));
    }
  

}
