<?php

namespace App\Http\Controllers;

use App\Category;
use App\ImageChild;
use App\Promocode;
use App\Purchase;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Mail;
class CheckoutController extends Controller {
    public function index() {
        if(!session()->has('cart') || count(session()->get('cart'))<=0 ) {
            return redirect('/');
        }
        $categories = Category::all();
        $page = "checkout";
        return view('checkout', compact('categories', 'page'));
    }

    public function getPromoCode(Request $request) {
        $promoCode = $request->input('promoCode');
        $getPromoCode  = Promocode::where('promocode', $promoCode)->first();
        return isset($getPromoCode) ? ['data' => $getPromoCode->amount,'status' => 'success'] : ['data' => '0','status' => 'error'];
        
    }
    public function success_page($id) {
        $categories = Category::all();
        $page = 'success';
        $purchase = Purchase::where('id',$id)->with('purchase_details')->first();
        foreach ($purchase->purchase_details as $purchase_detail) {
            $imageChild = ImageChild::where('id', $purchase_detail->image_id)->first();   
            $purchase_detail->thumbnail = $imageChild->thumbnail_url; 
            $purchase_detail->author = $imageChild->author; 
            $purchase_detail->title = $imageChild->title; 
        }
        $user = User::find($purchase->user_id);

        $pdfPath = 'pdf/invoice-'.time().'-'.$purchase->id.'.pdf';
        $pdf = PDF::loadView('web.invoice.index', compact('purchase','user'))->save(public_path($pdfPath));

        $this->sendMail($user,$purchase,$pdfPath);
        return view('success_page', compact('categories', 'page'));
    }
    public function failed_page() {
        $categories = Category::all();
        $page = 'failed';
        return view('error_page', compact('categories', 'page'));
    }
    public function sendMail($user,$purchase,$pdfPath) {
        $data["email"] = $user->email;
        $data["title"] = "From drikimages.com";
        $data["body"] = "Thank your purchase images from drikimages.Your purchase invoice-#".$purchase->id;

        $path = url("public/$pdfPath");
  
        Mail::send('emails.BillingEmailToUser', $data, function($message)use($data, $path) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"]);
                $message->attach($path);
            
        });
    }
}
