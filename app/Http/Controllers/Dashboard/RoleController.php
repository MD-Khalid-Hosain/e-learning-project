<?php

namespace App\Http\Controllers\Dashboard;

use Hash;
use Image;
use App\Admin;
use Carbon\Carbon;
// use Intervention\Image\Image;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class RoleController extends Controller
{
    /**
     * this function is showing role index blade file
     **/
    public function index()
    {
        // $permission = Permission::create(['name' => 'assign role']);
        $allPermission = Permission::all();
        $allRole = Role::all();
        return view('backend.layouts.role.index', compact('allPermission', 'allRole'));
    }
    /**
     * role create
     * role permission assign
     **/
    public function addRole(Request $request)
    {
        //validation
        $request->validate([
            'role_name' => 'unique:roles,name'
        ]);
        //role created
        $role = Role::create(['name' => $request->role_name]);
        //permission assign
        $role->givePermissionTo($request->permission);
        return back()->with('created_succcess', 'Role created successfully !!');
    }

    /**
     *see all user and their permission
     **/
    public function userDetails()
    {
        $alladmin = Admin::all();
        $allRole = Role::all();
        return view('backend.layouts.role.user_details', compact('alladmin', 'allRole'));
    }

    /**
     *Set user role and his/her permission
     **/
    public function assignRole(Request $request)
    {
        $user = Admin::find($request->user_id);
        $user->syncRoles($request->role_name);
        return back();
    }

    /**
     *Edit his/her permission
     **/
    public function editRole($id)
    {
        return view('backend.layouts.role.user_role_edit', [
            'permissions' => Permission::all(),
            'user' => Admin::find($id)
        ]);
    }

    /**
     *change permission
     **/
    public function changePermission(Request $request)
    {
        $user = Admin::find($request->user_id);
        $user->syncPermissions($request->permission);
        return back();
    }
    /**
     *Delete user
     **/
    public function deleteUser($id)
    {
        $admin =  Admin::find($id);
        if (file_exists(base_path() . '/public/backend/uploads/admin/' . $admin->image)) {
            @unlink(base_path() . '/public/backend/uploads/admin/' . $admin->image);
            $admin->delete();
            $message = "User Deleted Successfully !!";
            return back()->with('deletesuccess', $message);
        }
    }


    public function deleteRole($id)
    {
        Role::find($id)->delete();
        return back()->with('success', 'Role deleted successfully');
    }
}
