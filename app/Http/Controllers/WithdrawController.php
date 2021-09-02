<?php

namespace App\Http\Controllers;

use App\Category;
use App\ContributorWithdrawInformations;
use App\Http\Controllers\Controller;
use App\PaymentMethod;
use App\WithdrawRequest;
use Faker\Provider\ar_SA\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    public function withdraw()
    {
        if(Auth::user()->is_confirm != 1)
        {
            return redirect('your-dashboard');
        }
        $user = Auth::user();
        $categories = Category::where('parent_category_id', null)->get();
        $paymentMethods = PaymentMethod::all();
        $contributorWithdrawInformation = ContributorWithdrawInformations::where('contributor_id',$user->id)->first();
        return view('web.contributors.withdraw.withdraw', compact('categories', 'user','paymentMethods','contributorWithdrawInformation'));
    }

    public function submitWithdraw(Request $request)
    {
      
        $withdrawRequest = new WithdrawRequest();
        $withdrawRequest->user_id = Auth::user()->id;
        $withdrawRequest->amount = $request->amount;
        $withdrawRequest->payment_method = $request->payment_method;
        $withdrawRequest->bank_name = $request->bank_name;
        $withdrawRequest->bank_account_no = $request->bank_account_no;
        $withdrawRequest->bikash_no = $request->mobile_number;
        $withdrawRequest->date = date('Y-m-d');
        $withdrawRequest->status = 0;
        $result = $withdrawRequest->save();
        if($result)
        {
            return response(['data' => $withdrawRequest], 200);
        }
    }

    public function withdrawList()
    {
        if(Auth::user()->is_confirm != 1)
        {
            return redirect('your-dashboard');
        }
        $user = Auth::user();
        $contributorWithdrawInformation = ContributorWithdrawInformations::where('contributor_id',$user->id)->first();
        if(!empty($contributorWithdrawInformation) && (strtotime($contributorWithdrawInformation->muture_date) < strtotime(date('Y-m-d'))))
        {
            $today = date("Y-m-d");
            $contributorWithdrawInformation->muture_date =  date("Y-m-d",strtotime("$today +$contributorWithdrawInformation days"));
            $contributorWithdrawInformation->muture_amount = $contributorWithdrawInformation->muture_amount +  $contributorWithdrawInformation->total_amount ;
            $contributorWithdrawInformation->total_amount ="0.0";
            $contributorWithdrawInformation->save();
      
        }
        $categories = Category::where('parent_category_id', null)->get();
        $paymentMethods = PaymentMethod::all();
        $withdrawRequest = WithdrawRequest::with('paymentMethod')->where('user_id', Auth::user()->id)->orderBy('id','DESC')->get(); 
        $contributorWithdrawInformation = ContributorWithdrawInformations::where('contributor_id',$user->id)->first();
      
        return view('web.contributors.withdraw.withdraw_list', compact('categories', 'user','paymentMethods','withdrawRequest','contributorWithdrawInformation'));
    }

    public function index()
    {
        $withdrawRequest = WithdrawRequest::with('paymentMethod')->orderBy('id','DESC')->get(); 
        return view('backEnd.withdraw.create', compact('withdrawRequest'));
    }

    public function adminWithdrawApprove(Request $request)
    {
        // dump($request->all());
        $item = WithdrawRequest::find($request->id);
        $contributorWithdrawInformation = ContributorWithdrawInformations::where('contributor_id',$item->user_id)->first();
    //   dd($contributorWithdrawInformation);
        if($contributorWithdrawInformation->muture_amount >= $item->approve_amount)
        {
            $contributorWithdrawInformation->muture_amount = $contributorWithdrawInformation->muture_amount - $request->approve_amount ;
            $contributorWithdrawInformation->save();
     
            $item->status = 1;
            $item->approve_amount = $request->approve_amount;
            $item->message = $request->message;
            $item->status = 1;
            $item->save();
          
            
            $withdrawRequest = WithdrawRequest::with('paymentMethod','user')->orderBy('id','DESC')->get(); 
            return redirect()->back()->with('message-success','Withdraw Request Approved Successfully');
        }
        else
        {
            
            return redirect()->back()->with('message-success','Withdraw Request Approved Filed.You approve him more then this mature amount');
        }
       
        
    }
}
