<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\WelcomeEmail;
use App\Mail\SendForgotPasswordEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Reg_User ;
use App\Models\User ;;
use function Illuminate\Events\queueable;

class admincontroller extends Controller
{
    public function index(Request $Request){
   
        return view('admin.index');
    } 

    
    public function usersList(Request $request)
    {
        $users = User::all();
        return view('admin.admin_layout.users_list', compact('users'));
    }
    
    public function editUsers(Request $Request, $id){
                    
        $user=User::find($id);
        if(empty($user)){
            return back()->with('warning', 'user not found');
        }
   
        return view('admin.admin_layout.users_edit' , compact('user'));
    } 



    public function updateUsers(Request $Request, $id){
          
        $this->validate($Request,[
            
            'fname' => 'required|min:5|max:10|string',
            'lname' => 'required|min:5|max:15|string|different:fname',
            'email' => 'required|email',
            'contact' => 'numeric|nullable',
            'gender' => 'required',
            'role_id' => 'required|in:0,1',
            'country' => 'required',
            'address' => 'nullable|string|max:100',
        ]);
        $RequestData=$Request->except(['_token','_method','update']);
        $user=User::find($id);
        if(!empty($user)){
            $user->update($RequestData);
            return redirect()->route('admin_user_list')->with('success','user updated successfully.');           
        }
   
        return redirect()->route('admin_user_list')->with('danger','user not updated .');           
           
       
    } 



    public function updateUsersProfile(Request $Request, $id){
          
        $RequestData=$Request->except(['_token','_method','update']);
        $imgname='zeeshu_'. rand() .'.' . $Request->profile->extension();
        $Request->profile->move(public_path('profiles/'),$imgname);
        $RequestData['profile']=$imgname;
        $user=User::find($id);
        if(!empty($user)){
            $exitingprofile=$user->profile;
            $user->update($RequestData);
            $profileExists = public_path("profiles/$exitingprofile");
            if(file_exists($profileExists)) {
                unlink("profiles/$exitingprofile");
            }
            return redirect()->route('admin_user_list')->with('success','image updated successfully.');           
        }
   
        return redirect()->route('admin_user_list')->with('danger','user not updated .');  
               
    }
    
    
    public function registerUsersProfile( Request $request){
       
        return view('admin.admin_layout.admin_register');
    }




    public function registerUsersProfileData(Request $Request){
          
        $this->validate($Request,[
            'fname' => 'required|min:5|max:10|string',
            'lname' => 'required|min:5|max:15|string|different:fname',
            'email' => 'required|min:5|max:50|unique:users,email',
            'password' => 'required|min:8|',
            'contact' => 'numeric|nullable',
            'gender' => 'required',
            'address' => 'nullable|string|max:100',
            'profile' => 'required|mimes:jpg,jpeg,png',
        ]);
        $requestdata=$Request->except(['_token','regist']);
        $imgname='zeeshu_'.rand().'.'. $Request->profile->extension();
        $Request->profile->move(public_path('profiles/').$imgname);
        $requestdata['profile']=$imgname;
        $requestdata['password']=Hash::make($Request->password);
        $requestdata['role_id']=User::USER_ROLE;
        $user=User::create($requestdata);
        event(new WelcomeEmail($user));
        return redirect()->route('admin_user_list')->with('success','User Inserted Successfully.');           
       
    } 
    public function changeUserStatus(Request $Request, $id , $status = 1){
                    
        $user=User::find($id);
        if(!empty($user)){
           $user->is_Active= $status;
           $user->save();
            return redirect()->route('admin_user_list')->with('success','Status updated successfully.');           
        }
   
        return redirect()->route('admin_user_list')->with('danger','Status not updated .'); 
    } 
}
