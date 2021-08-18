<?php

namespace App\Http\Controllers;

use App\Category;
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
        return view('web.contributors.withdraw.withdraw', compact('categories', 'user','paymentMethods'));
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
        $categories = Category::where('parent_category_id', null)->get();
        $paymentMethods = PaymentMethod::all();
        $withdrawRequest = WithdrawRequest::with('paymentMethod')->where('user_id', Auth::user()->id)->orderBy('id','DESC')->get(); 
        return view('web.contributors.withdraw.withdraw_list', compact('categories', 'user','paymentMethods','withdrawRequest'));
    }

    public function index()
    {
        $withdrawRequest = WithdrawRequest::with('paymentMethod')->orderBy('id','DESC')->get(); 
        return view('backEnd.withdraw.create', compact('withdrawRequest'));
    }

    public function adminWithdrawApprove(Request $request)
    {
        $item = WithdrawRequest::find($request->id);
        $item->status = 1;
        $item->save();

        $withdrawRequest = WithdrawRequest::with('paymentMethod','user')->orderBy('id','DESC')->get(); 
        return view('backEnd.withdraw.inner_div', compact('withdrawRequest'));
    }
}
