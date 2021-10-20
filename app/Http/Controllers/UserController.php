<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Replace;

class UserController extends Controller {
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }

    public function registration(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'email' => 'required|email|unique:users'
        ]);

        $name = $request["first_name"]. " ".$request["last_name"];
        $userType = $request["user_type"];
        $email = $request["email"];
        $company = $request["company_name"];
        $job = $request["job_title"];
        $phone = $request["phone"];
        // $country = $request["country"];
        $password = Hash::make($request["password"]);

        $encryptedEmail = Hash::make($request->email).strtotime(date('Today'));
        $encryptedEmail = str_replace('/','_',$encryptedEmail);

        // dd($encryptedEmail);

        $inputs = [
            'name' => $name,
            'user_type' => $userType,
            'email' => $email,
            'company_name' => $company,
            'job_title' => $job,
            'password' => $password,
            'phone' => $phone,
            // 'country' => $country,
            'is_verify_url' => 0,
            'verify_url' => $encryptedEmail,
        ];

        if($userType === "1") {
            $inputs["active_status"] = 0;
        } else {
            $inputs["active_status"] = 1;
        }

        if($userType === "1") {
            $inputs["is_confirm"] = 0;
        }



        User::create($inputs);

        $body = "Please click this link and verify your email.Link: <a href='".url('verify_email/'.$encryptedEmail)."' target='_blank'>".url('verify_email/'.$encryptedEmail)."</a>";

        $this->sendMail( $email,$body);

        return redirect()->route('user-login')->with('message-danger',"Please Verify your email first");
    }

    public function sendMail($email,$body) {
        $data["email"] = $email;
        $data["title"] = "From drikimages.com"; 
        $data["body"] = $body;

  
        Mail::send('emails.verify_email', $data, function($message)use($data) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"]);
                
            
        });
    }

    public function make_login(Request $request)
    {
        $user = User::where('email', $request["email"])->first();
        if($user->is_verify_url == 1)
        {
            if($user && Hash::check($request["password"], $user->password)){
                Auth::login($user);
                if($request->session()->has('url'))
                {
                    $url = $request->session()->get('url');
                    $request->session()->forget('url');
                    return redirect($url);
                }
                return redirect()->route('your-dashboard')->with('message-success',"Welcome to your dashboard.$user->name");
            } else {
                return redirect()->back()->with('message-danger',"Your credentials are incorrect");
            }
        }
        else
        {
            return redirect()->back()->with('message-danger',"Please Verify your email");
        }
       
    }

    public function logout() {
        // Auth::logout();
        // return redirect('home');
        return redirect('/')->with(Auth::logout());
    }

    public function verfiyUrl($verfiy_url)
    {
       $user = User::where('verify_url',$verfiy_url)->where('is_verify_url',0)->first();
        if(isset($user))
        {   
            $user->is_verify_url = 1;
            $user->save();
            return redirect('user-login')->with('message-success',"Your email is verified successfully");
        
        }
        else
        {
            return abort(403);
        }
    }

    public function forgotPasswordEmail()
    {
        return view('forgot-password-email');
    }

    public function sendEmailForgotPassword(Request $request)
    {
        $user = User::where('email',$request["email"])->first();
        if(isset($user))
        {
            $encryptedEmail = Hash::make($request->email).strtotime(date('Today'));
            $encryptedEmail = str_replace('/','_',$encryptedEmail);

            $user->forgot_password_url = $encryptedEmail;
            $user->save();

            $body =  "Please click this link and Reset your password.Link: <a href='".url('reset_password/'.$encryptedEmail)."' target='_blank'>".url('reset_password/'.$encryptedEmail)."</a>";
            $this->sendMail($request["email"],$body);

            return redirect('user-login')->with('message-success',"Please check your email to reset your password");
        }
        else
        {
            return redirect()->back()->with('message-danger',"Email not found");
        }
    }

    public function resetPassword($verfiy_url)
    {
        $user = User::where('forgot_password_url',$verfiy_url)->first();
        if(isset($user))
        {   
            $user->forgot_password_url = '';
            $user->save();
            return redirect('user-reset-password/'.$user->id)->with('message-success',"Your email is verified successfully");
        
        }
        else
        {
            return abort(403);
        }
    }

    public function userResetPassword($id)
    {
        $user = User::find($id);
        if(isset($user))
        {   
            return view('forgot-password',compact('user'));
        
        }
        else
        {
            return abort(403);
        }
        
    }

    public function forgotPassword(Request $request)
    {
        $id = $request->id;
   
        $request->validate([
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::find($id);
        $user->password = Hash::make($request["password"]);
        $user->save();
        
        return redirect('user-login')->with('message-success',"Password updated successfully");
    }
   
}
