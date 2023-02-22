<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Helper\Helpers;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileStoreRequest;
use App\Http\Requests\ProfilePasswordResetRequest;

class ProfileController extends Controller
{
    public function index(){
        Gate::authorize('profile-update');
        //authorize this user to access or not
        $user = User::with('userInfo')->find(Auth::id());
        return view('admin.pages.profile.index',compact('user'));
    }

    public function updateProfile(ProfileStoreRequest $request){

        Gate::authorize('profile-update');
        //authorize this user to access or not
        $user = User::find($request->id);
        $user->update([
            'name' => $request->name,
        ]);
        $userInfo = UserInfo::where('user_id',$user->id)->first();
        // dd($userInfo);

        if($userInfo==null){
            UserInfo::create([
            'user_image' => Helpers::upload('uploads/users/', 'png', $request->file('user_image')),
            'user_id' => $user->id,
            'phone' => $request->phone,
            'address' => $request->address,
            'state' => $request->state,
            'zipCode' => $request->zipCode,
            ]);
        }else{
            UserInfo::where('id',$userInfo->id)->update([
            'user_image' => $request->has('user_image') ? Helpers::update('uploads/users/', $userInfo->user_image, 'png', $request->file('user_image')) : $userInfo->user_image,
            'user_id' => $user->id,
            'phone' => $request->phone,
            'address' => $request->address,
            'state' => $request->state,
            'zipCode' => $request->zipCode,
        ]);
        }
        Toastr::success('User Updated Successfully', 'Success',);
        return back();
    }

    public function password(){
        Gate::authorize('password-update');
        //authorize this user to access or not
        return view('admin.pages.profile.resetPassword');
    }
    public function updatePassword(ProfilePasswordResetRequest $request){
        Gate::authorize('password-update');
        //authorize this user to access or not
       $user = Auth::user();
        $hashedPassword = $user->password;

        // existing password === request password
        if(Hash::check($request->old_password, $hashedPassword)){

            // new password == old stored passowrd
            if(!Hash::check($request->password, $hashedPassword)){
                $user->update([
                    'password' => Hash::make($request->password),
                ]);

            Auth::logout();
            Toastr::success('password updated successfully','success');
            return redirect()->route('login');
            }else{
                Toastr::error('New Password cannot be the same as old password','error');
                return back();
            }
        }else{
            Toastr::error("Old Password doesn't match",'error');
            return back();
        }
    }
}
