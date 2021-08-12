<?php

namespace App\Http\Controllers;

use App\Category;
use App\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    public function contact()
    {
        $categories = Category::all();
        $user = Auth::user();
        $page = 'Contact';
        return view('contact',compact('categories','user','page'));
    }
    public function submitContact(Request $request)
    {
        $contactUs = new ContactUs();
        $contactUs->name = $request->name;
        $contactUs->email = $request->email;
        $contactUs->message = $request->message;
        $contactUs->date = date('Y-m-d');
        $result = $contactUs->save();

        if($result)
        {
            return redirect()->back()->with('message-success','Your message has been sent successfully');
        }
        else
        {
            return redirect()->back()->with('message-danger','Your message has not been sent');
        }


    }
}
