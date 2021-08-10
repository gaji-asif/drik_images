<?php

namespace App\Http\Controllers;
use App\Category;
use App\ImageChild;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PDF;

use function React\Promise\reduce;

class GalleryController extends Controller {
    public function index() {

        // $data["email"] = "billing.info@drikimages.com";
        // $data["title"] = "From drikimages.com";
        // $data["body"] = "This is Demo";
 
        // $files = [
        //     url('public/billing_pdf/billing_pdf_1.pdf'),
        //     url('public/billing_pdf/billing_pdf_2.pdf'),
        //     url('public/billing_pdf/billing_pdf_3.pdf'),
        // ];
  
        // Mail::send('emails.BillingEmailToUser', $data, function($message)use($data, $files) {
        //     $message->to($data["email"], $data["email"])
        //             ->subject($data["title"]);
 
        //     foreach ($files as $file){
        //         $message->attach($file);
        //     }
            
        // });
 
  
        $categories = Category::all();
        $images = ImageChild::paginate(10);
       // abort_if($images->isEmpty(),204);
        $user = Auth::user();
        $home = 'home';
        // dd($images);
        return view('welcome', compact('images', 'categories', 'user', 'home'));
    }
    public function shareImage($id) {
        $categories = Category::all();
        $image = ImageChild::find($id);
        $user = Auth::user();
        $page = 'Share';
        if(is_null($image)) {
            return redirect('/');
        }
       
        return view('sharePage', compact('image', 'categories', 'user', 'page'));
    }


  
}
