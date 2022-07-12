<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
     public function AdminProfile(){
        $adminData = Admin::findOrFail(4);//To get only 1 row from the table
        return view('admin.admin_profile_view',compact('adminData'));
    }

    public function EditProfile(){
        $profileData = Admin::findOrFail(4);//To get only 1 row from the table
        return view('admin.admin_profile_edit',compact('profileData'));
    }

    public function StoreProfile(Request $request){
        $profileData = Admin::findOrFail(4);//To get only 1 row from the table
        $profileData->name = $request->name;
        $profileData->email = $request->email;
        //$profileData->username = $request->username;

        if ($request->file('profile_photo_path')) {
           $file = $request->file('profile_photo_path');
           @unlink(public_path('upload/admin_images/'.$profileData->profile_photo_path));
           $filename = date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/admin_images'),$filename);
           $profileData['profile_photo_path'] = $filename;
        }
        $profileData->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully', 
            'alert-type' => 'info'
        );

        return redirect()->route('admin.profile')->with($notification);
    }

    public function ChangePassword(){
         return view('admin.admin_change_password');
    }

    public function UpdatePassword(Request $request){
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirm_password' => 'required|same:newpassword',

        ]);

        $hashedPassword = Admin::find(4)->password;
        if (Hash::check($request->oldpassword,$hashedPassword )) {
            $admin = Admin::findOrFail(4);//To get only 1 row from the table
            $admin->password = Hash::make($request->newpassword);
            $admin->save();
            //Auth::logout();

            session()->flash('message','Admin Password Updated Successfully');
            return redirect()->back();
        } else{
            session()->flash('message','Old password is not match');
            return redirect()->back();
        }
    }
}
