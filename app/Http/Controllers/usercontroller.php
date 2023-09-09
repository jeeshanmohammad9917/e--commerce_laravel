<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\brand;
use App\Models\product;


class usercontroller extends Controller
{
    public function userprofile(Request $Request){
        $user = auth()->user();
        //           echo"<pre>";
        // print_r(asset('profile').'/'.$user->profile);
        // exit;
        return view('user_profile' , compact('user'));
    }
    public function Home(Request $Request){
        $products = product::all();
   
        return view('user_index' , compact('products'));
    }
    public function userprofileupdate(Request $Request){
        
        $this->validate($Request,[
            'fname' => 'required|min:5|max:10|string',
            'lname' => 'required|min:5|max:15|string|different:fname',
            'email' => 'required|min:5|max:50|exists:users,email',
            'contact' => 'numeric|nullable',
            'gender' => 'required',
            'country' => 'required',
            'address' => 'nullable|string|max:100',
        ]);
        $RequestData=$Request->except(['_token','_method','update']);
        $user=User::find(auth()->user()->id);
        $user->update($RequestData);
        return redirect()->route('user_profile')->with('success','user inserted successfully.');
    }
    
    public function userimageupdate(Request $Request){
        $this->validate($Request,[
            'profile' => 'required|mimes:jpg,jpeg,png',
        ]);
        $RequestData=$Request->except(['_token','_method','update']);
        $imgname='zeeshu_'. rand() .'.' . $Request->profile->extension();
        $Request->profile->move(public_path('profiles/'),$imgname);
        $RequestData['profile']=$imgname;
        $user=User::find(auth()->user()->id);
        $exitingprofile=$user->profile;
        $user->update($RequestData);
        $profileExists = public_path("profiles/$exitingprofile");
        if(file_exists($profileExists)) {
            unlink("profiles/$exitingprofile");
        }
        return redirect()->route('user_profile')->with('success','user profile image updated successfully.');

    }
    
}
