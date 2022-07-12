<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function Index(){
        return view('frontend.index');
    }

    public function UserLogout(){
        Auth::logout();
        return Redirect()->route('login');
    }

    public function UserProfile(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile',compact('user'));
    }

    public function StoreUserProfile(Request $request){
        $profileData = User::findOrFail(Auth::user()->id);//To get only 1 row from the table
        $profileData->name = $request->name;
        $profileData->email = $request->email;
        $profileData->phone = $request->phone;

        if ($request->file('profile_photo_path')) {
           $file = $request->file('profile_photo_path');
           @unlink(public_path('upload/user_images/'.$profileData->profile_photo_path));
           $filename = date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/user_images'),$filename);
           $profileData['profile_photo_path'] = $filename;
        }
        $profileData->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);
    }


     public function ChangeUserPassword(){
        $id = Auth::user()->id;
        $user = User::find($id);
         return view('frontend.profile.user_change_password',compact('user'));
    }

    public function UpdateUserPassword(Request $request){
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
            

        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword,$hashedPassword )) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();

           


            Auth::logout();

            $notification = array(
            'message' => 'User Profile Updated Successfully', 
            'alert-type' => 'success'
        );
            return redirect()->route('dashboard')->with($notification);
        } else{
          
            return redirect()->back();
        }
    }
}
