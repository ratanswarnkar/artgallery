<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\Admin;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Mail;


class AdminController extends Controller
{
    //

    public function dashboard()
{
    $artistCount   = \App\Models\Artist::count();
    $paintingCount = \App\Models\Painting::count();  // Count paintings
    $admin_usersCount = \App\Models\AdminUser::count();  // Count admin users


    return view('admin.dashboard', compact(
        'artistCount',
        'paintingCount',
        'admin_usersCount',
    ));
}

public function analytics()
{
    return view('admin.analytics');
}




    public function login(){
        return view('admin.login');
    }
    public function login_submit(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

       $check= $request->all();
       $data = [
        'email'=>$check['email'],
        'password'=>$check['password']
];

if(Auth::guard('admin')->attempt($data)){
    return redirect()->route('admin_dashboard');
}else{
    return redirect()->back()->with('error','Invalid Credentials');
    }
}

public function logout(){
    Auth::guard('admin')->logout();
    return redirect()->route('admin_login')->with('success','Admin Logout Successfully');
}

    public function forget_password(){
        return view('admin.forget_password');
    }

    public function forget_password_submit(Request $request){
        $request->validate([
            'email'=>'required|email'
        ]);
        $admin= Admin::where('email',$request->email)->first();
        if(!$admin){
            return redirect()->back()->with('error','Email not found');
    }
    $token=hash('sha256',time());
    $admin->token=$token;
    $admin->update();

    $Link=route('admin_reset_password',[$token,$request->email]);
    $subject='Reset Password';
    $message='Click on the following link to reset you password: <br>';
    $message.='<a href="'.$Link.'">'.$Link.'</a>';
    \Mail::to($request->email)->send(new Websitemail($subject,$message));
    return redirect()->back()->with('success','Reset Password Link Sent to Your Email');
    }


    public function reset_password($token,$email){
        $admin= Admin::where('email',$email)->where('token',$token)->first();
        if(!$admin){
            return redirect()->route('admin_login')->with('error','Invalid Link');
        }
      return view('admin.reset_password', compact('token','email'));
    }

    public function reset_password_submit(Request $request, $token, $email){
        $request->validate([
            'password'=>'required',
            'confirm_password'=>'required|same:password'
        ]);

        $admin= Admin::where('email',$email)->where('token',$token)->first();
        $admin->password= Hash::make($request->password);
        $admin->token='';
        $admin->update();

        return redirect()->route('admin_login')->with('success','Password Reset Successfully');
    }


     public function profile(){
        return view('admin.profile');
    }

    public function profile_submit(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:admins,email,'.Auth::guard('admin')->user()->id,
        ]);

        $admin=Admin::where('id',Auth::guard('admin')->user()->id)->first();

        if($request->photo){
            $request->validate([
                'photo'=>'image|mimes:png,jpg,jpeg,gif,svg|max:2048'
            ]);

            $finalname= 'admin_'.time().'.'.$request->photo->extension();
            if($admin->photo != '' ){
                $path=public_path().'/uploads/users/'.$admin->photo;
        }
        $request->photo->move(public_path().'/uploads/users/',$finalname);
        $admin->photo=$finalname;
    }

    if($request->password){
        $request->validate([
            'password'=>'required',
            'confirm_password'=>'required|same:password'
        ]);
        $admin->password= Hash::make($request->password);
    }

        
        $admin->name=$request->name;
        $admin->email=$request->email;
        $admin->update();

        return redirect()->back()->with('success','Profile Updated Successfully');
    }


}
