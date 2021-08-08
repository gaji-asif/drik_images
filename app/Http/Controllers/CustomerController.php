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
use App\User;
use Illuminate\Support\Facades\Hash;
use Session;
use DataTables;

class CustomerController extends Controller {
    public function index() {
        $categories = Category::all();
        $images = ImageChild::all();
        $user = Auth::user();
        if(is_null($user)) {
            return redirect()->route('user-login');
        }
        if($user->user_type == 1){//contributors
            return view('web.contributors.dashboard', compact('images', 'categories', 'user'));
        }else{
            return view('web.customers.dashboard', compact('images', 'categories', 'user'));
        }
    }

    public function getPurchasedInfo(Request $request)
    {
        $user = Auth::user();
        $data = DB::table('purchase_histories')
                ->leftjoin('all_images_childs', 'all_images_childs.id', '=', 'purchase_histories.image_id')
                ->select('purchase_histories.*', 'all_images_childs.image_name', 'all_images_childs.small_url', 'all_images_childs.small_price')
                ->where('purchase_histories.user_id', $user->id)
                ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($data) {
                if ($data->payment_status == 1) {
                    $status = '<label class="label label-success">Complete</label>';
                } else {
                    $status = '<label class="label label-warning">Pending</label>';
                }
                return $status;
            })
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" class="btn btn-success btn-sm">Download</a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }


    public function profile(){
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

        return redirect('customer-profile')->with('message-success', 'Profile has been updated');
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
        $categories = Category::all();
        return view('web.contributors.upload', compact('categories', 'user'));
    }
    

    public function promocode() {
        $categories = Category::all();
        $images = ImageChild::all();
        $user = Auth::user();
        $promocode = DB::table('promocodes')->get();
        return view('web.customers.promocode', compact('images', 'categories', 'user', 'promocode'));
    }

//    public function send_email(Request $request)
//    {
//        $request->validate([
//            'receiver_id' => 'required',
//            'msg' => 'required'
//        ]);
//
//        $users_details = User::where('id', '=', $request->receiver_id)->first();
//
//        $email = new ErpSendDoc();
//
//        $email->receiver_id = $request->receiver_id;
//        $email->sender_id = Auth::user()->id;
//        $email->doc_id = $id;
//        $email->msg = $request->msg;
//        $result = $email->save();
//
//        if ($result) {
//            $mailData = array(
//                'email' => $users_details->email,
//                'receiver_id' => $request->receiver_id,
//            );
//            $mailSent = Mail::to($users_details->email)
//                ->send(new SendEmailToUser($mailData));
//            if ($mailSent) {
//                return redirect('preview_doc/' . $id)->with('message-success', 'Document has been send successfully');
//            } else {
//                return redirect('preview_doc/' . $id)->with('message-success', 'Document has been send successfully');
//            }
//        }
//    }
}
