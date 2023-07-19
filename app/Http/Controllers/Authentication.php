<?php

namespace App\Http\Controllers;

use App\Events\WelcomeEmail;
use App\Mail\SendForgotPasswordEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Reg_User ;
use App\Models\User ;;
use function Illuminate\Events\queueable;


class Authentication extends Controller
{
    public function register( Request $request){
       
        return view('register');
    }
    public function storeuser( Request $request){
    
        $this->validate($request,[
            'fname' => 'required|min:5|max:10|string',
            'lname' => 'required|min:5|max:15|string|different:fname',
            'email' => 'required|min:5|max:50|unique:users,email',
            'password' => 'required|min:8|',
            'contact' => 'numeric|nullable',
            'gender' => 'required',
            'address' => 'nullable|string|max:100',
            'profile' => 'required|mimes:jpg,jpeg,png',
        ]);
        $requestdata=$request->except(['_token','regist']);
        // echo"<pre>";
        // print_r($requestdata);
        // exit;
        $imgname='zeeshu_'.rand().'.'. $request->profile->extension();
        $request->profile->move(public_path('profiles/').$imgname);
        $requestdata['profile']=$imgname;
        $requestdata['password']=Hash::make($request->password);
        $requestdata['role_id']=User::USER_ROLE;
        $user=User::create($requestdata);
        //    echo"<pre>";
        // print_r($user);
        // exit;
        event(new WelcomeEmail($user));
        return redirect()->route('login',[] , 301)->with('success','user inserted successfully.');
        
    }
    public function login( Request $request){
       
        return view('login');

    }
    public function authenticate( Request $request){
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('email' ,'password');
        if(Auth::attempt($credentials)){
            if(auth()->user()->role_id == User::ADMIN_ROLE){
                return redirect()->route('admin_home',[] , 301);
            } else {
                return redirect()->route('user_index',[] , 301);
            }
        }
        else{
            return redirect()->intended('login',[] , 301)->withSuccess('please try again');

        }
        // fetch all table data
        // if(Auth::attempt($credentials)){
        //     $user = auth()->user();
        //                    echo"<pre>";
        //                     print_r($user);
        //                     exit;
        // }
        //        echo"<pre>";
        // print_r($request->all());
        // exit;

    }
    public function forgotpassword( Request $request){
        return view('forgotpassword');

    }
    public function sendForgotPasswordEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
        ]);
        $requestData = $request->except('_token' , 'submit');
        $requestData['token'] = Str::random('30');
        $forgotPasswordData = DB::table('password_reset_tokens')->insert($requestData);
        Mail::to($requestData['email'])->send(new SendForgotPasswordEmail($requestData));
        return redirect()->route('forgotpassword',[] , 301)->with('success','email send successfully.');

    }
    public function resetPassword(Request $request, $token)
    {
        $checkData = DB::table('password_reset_tokens')->where('email', $request->email)->where('token', $token)->count();
        if($checkData > 0) {
            $email = $request->email;
            return view('reset_password', compact('email'));
        } else {
            return redirect()->route('forgotpassword',[] , 301)->with('danger', 'Invalid token.');
        }
    }

    public function resetPasswordData(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password',
        ]);
        User::where('email', $request->email)->update(['password' => bcrypt($request->password)]);
        return redirect()->route('login',[] , 301)->with('success','Password Reset Successfully.');

    }

    public function out( Request $request){
        Auth::logout();
        Session::flush();
        return redirect('/login');
    }
    
}
