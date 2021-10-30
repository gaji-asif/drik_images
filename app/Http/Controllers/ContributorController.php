<?php

namespace App\Http\Controllers;

use App\ContributorWithdrawInformations;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ImageChild;
use App\ImageSellPercentage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

// use Illuminate\Validation\Rule;
// use Validator;

class ContributorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::where('user_type', '=', 1)->get();
        $image_sell_percetages = ImageSellPercentage::all();
        
        return view('backEnd.contributers.create', compact('users','image_sell_percetages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

     $users = User::where('email', '=', $request->email)->first();

     if(!empty($users->email)){
        return redirect()->back()->with('message-danger', 'Email Exists');
     }
     else{
         $data = new User();
        $data->name = $request->first_name;
        $data->company_name = $request->company_name;
        $data->job_title = $request->job_title;
        $data->user_type = 1;
        $data->password = Hash::make("123456");
     
        $data->email = $request->email;
        $data->is_confirm = 0;
        $results = $data->save();
        if ($results) {
            return redirect()->back()->with('message-success', 'Contributer has been added');
        } else {
            return redirect()->back()->with('message-danger', 'Something went wrong');
        }
     }





    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$data = Category::with('children')->get();
        //$parent_cat = Category::where('parent_category_id', 0)->get();
        $users = User::where('user_type', '=', 1)->get();
        $editData = User::find($id);
        $image_sell_percetages = ImageSellPercentage::all();
 
        return view('backEnd.contributers.create', compact('editData', 'users','image_sell_percetages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //echo "adasd"; exit;
        
        $data = User::find($id);
        
        if($data->is_confirm == 0 && $request->is_confirm == 1)
        {
            $contributor_withdraw_information = ContributorWithdrawInformations::where('contributor_id',$id)->first();
            if(empty($contributor_withdraw_information))
            {
                $period = 45;
                $today = date("Y-m-d");
           
                $contributor_withdraw_information = new ContributorWithdrawInformations();
                $contributor_withdraw_information->	contributor_id = $id;
                $contributor_withdraw_information->muture_date = date("Y-m-d",strtotime("$today +$period days"));
                $contributor_withdraw_information->total_amount = "0.0";
                $contributor_withdraw_information->muture_amount = "0.0"; 
                $contributor_withdraw_information->muture_period = $period; 
                $contributor_withdraw_information->save(); 
            }
            
            $this->sendMail($data);

        }

        $data->name = $request->first_name;
        $data->company_name = $request->company_name;
        $data->job_title = $request->job_title;
        $data->email = $request->email;
        $data->is_confirm = $request->is_confirm;
        $data->contributor_percentage = $request->image_sell_percetages;
        $results = $data->save();
      

        if ($results) {
            return redirect('contributor')->with('message-success', 'Contributer has been Updated');
        } else {
            return redirect('contributor')->with('message-danger', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function deleteCategory($id)
    {
        $data = Category::find($id);
        $results = $data->delete();
        if ($results) {
            return redirect('category')->with('message-success', 'Category has been Deleted');
        } else {
            return redirect('category')->with('message-danger', 'Something went wrong');
        }
    }

    public function deleteContributor($id)
    {
        $data = User::find($id);
        $results = $data->delete();
        if ($results) {
            return redirect('contributor')->with('message-success', 'User has been Deleted');
        } else {
            return redirect('contributor')->with('message-danger', 'Something went wrong');
        }
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
                'is_confirm' => 1
            ]);

            if($updated) {
                return response()->json(['status' => 200], 200);
            } else {
                return response()->json(['status' => 500], 500);
            }
        }

        return response()->json(['status' => 404], 404);
    }
    
    public function sendMail($user) {
        $data["email"] = $user->email;
        $data["title"] = "From drikimages team";
        $data["body"] = $user->firstname." ".$user->lastname;

  
        Mail::send('emails.congratulations', $data, function($message)use($data) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"]);
            
        });
    }
}
