<?php

namespace App\Http\Controllers\Backend;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\PermissionStoreRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('index-permission');
        //authorize this user to access or not

        $modules = Module::select('id','module_name')->get();
        $permissions = Permission::with(['module:id,module_name,module_slug'])
        ->select(['id','module_id','permission_slug','permission_name','updated_at'])
        ->latest('id')
        ->paginate(10);
        return view('admin.pages.permission.index',compact('permissions','modules'));
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
    public function store(PermissionStoreRequest $request)
    {
       Gate::authorize('create-permission');
        //authorize this user to access or not
        Permission::updateOrCreate([
            'module_id'=> $request->module_id,
            'permission_name'=> $request->permission_name,
            'permission_slug'=> Str::slug($request->permission_name),
        ]);

        Toastr::success('Permission Created Successfully', 'Success',);
        return redirect()->route('admin.permission.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionStoreRequest $request, $permission_slug)
    {
        Gate::authorize('edit-permission');
        //authorize this user to access or not
        $module = Permission::wherePermission_slug($permission_slug)->first();
        $module->update([
            'module_id'=> $request->module_id,
            'permission_name'=> $request->permission_name,
            'permission_slug'=> Str::slug($request->permission_name),
        ]);

        Toastr::success('Permission Update Successfully', 'Success',);
        return redirect()->route('admin.permission.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($permission_slug)
    {
        Gate::authorize('delete-permission');
        //authorize this user to access or not
        $module = Permission::wherePermission_slug($permission_slug);
         $module->delete();
         Toastr::success('Permission Delete Successfully', 'Success',);
         return redirect()->route('admin.permission.index');
    }
}
