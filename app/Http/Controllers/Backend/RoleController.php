<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\User;
use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('index-role');
        //authorize this user to access or not
        $roles = Role::with(['permissions:id,permission_name,permission_slug'])
        ->with(['user:role_id,id,name'])
        ->select(['id','role_name','role_slug','is_deleteable','updated_at'])
        ->paginate(10);
        // $users = User::select('role_id')->get();
        return view('admin.pages.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('create-role');
        //authorize this user to access or not
        $modules = Module::with(['permissions:id,module_id,permission_slug,permission_name'])
            ->select('module_name','id')
            ->get();
            return view('admin.pages.role.create',compact('modules'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        Gate::authorize('create-role');
        //authorize this user to access or not
        Role::updateOrCreate([
            'role_name'=>$request->role_name,
            'role_slug'=>Str::slug($request->role_name),
            'role_note'=>$request->role_note,
        ])->permissions()->sync($request->input('permissions',[]));
        Toastr::success('Role Created Successfully', 'Success',);
        return redirect()->route('admin.role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($role_slug)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($role_slug)
    {
        Gate::authorize('edit-role');
        //authorize this user to access or not
        $role = Role::with(['permissions'])->whereRole_slug($role_slug)->first();
        $modules = Module::with(['permissions:id,module_id,permission_slug,permission_name'])
            ->select('module_name','id')
            ->get();
        return view('admin.pages.role.edit',compact('role','modules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, $role_slug)
    {
        Gate::authorize('create-role');
        //authorize this user to access or not
        $role = Role::whereRole_slug($role_slug)->first();
        $role->update([
            'role_name'=>$request->role_name,
            'role_slug'=>Str::slug($request->role_name),
            'role_note'=>$request->role_note,
        ]);
        $role->permissions()->sync($request->input('permissions',[]));
        Toastr::success('Role Updated Successfully', 'Success',);
        return redirect()->route('admin.role.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($role_slug)
    {
       Gate::authorize('delete-role');
       //authorize this user to access or not
        $role = Role::whereRole_slug($role_slug)->first();
        if($role->is_deleteable){
            $role->delete();
            Toastr::success('Role Deleted Successfully', 'Success',);
            return redirect()->route('admin.role.index');
        }
        Toastr::error('Role not Deleteable', 'error',);
        return redirect()->route('admin.role.index');
    }
}
