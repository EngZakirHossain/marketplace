<?php

namespace App\Http\Controllers\Backend;


use App\Models\Role;
use App\Models\User;
use App\Helper\Helpers;
use App\Models\UserInfo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('index-user');
        //authorize this user to access or not
        $users = User::with(['role:id,role_name,role_slug'])
        ->select('id','role_id','name','email','updated_at','password','is_active','created_at')
        ->latest('id')
        ->paginate(10);
        $roles = Role::select('id','role_name',)->get();
        return view('admin.pages.user.index',compact('users','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        Gate::authorize('create-user');
        //authorize this user to access or not
        User::updateOrCreate([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password), // password
            'remember_token' => Str::random(10),
            'is_active' => '1',
        ]);
        Toastr::success('User Created Successfully', 'Success',);
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Gate::authorize('create-user');
        //authorize this user to access or not
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        Gate::authorize('edit-user');
        //authorize this user to access or not
        $user = User::find($id);
        $user->update([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // password
        ]);
        Toastr::success('User Update Successfully', 'Success',);
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('delete-user');
        //authorize this user to access or not
        $user = User::find($id);
        $userImage = UserInfo::where('user_id',$user->id)->first();
        Helpers::delete('uploads/users/' . $userImage->user_image);

        $user->delete();
        Toastr::success('User Delete Successfully', 'Success',);
        return redirect()->route('admin.users.index');
    }

    public function checkActive (Request $request){
        $user = User::find($request->user_id);
        if($user->is_active == 1){
            $user->is_active = 0;
        }else{
            $user->is_active = 1;
        }
        $user->update();

        return response()->json([
            'type' => 'success',
            'message' => 'User Status Updated',
        ]);

    }
}
