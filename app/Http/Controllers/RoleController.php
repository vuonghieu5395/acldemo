<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleController extends Controller
{
    private $role;
    private $permission;
    //
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index(){
        $listRole = $this->role->all();
        return view('role.index', compact('listRole'));
    }

    // create role
    public function create(){
        $permissions = $this->permission->all();
        return view('role.add', compact('permissions'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // insert data đến bảng user table
            $roleCreate = $this->role->create([
                'name' => $request->name,
                'display_name' => $request->display_name,
            ]);

            // insert qua relationship eloquence
            $roleCreate->permission()->attach($request->permission);  // $request->permission: permission là name trong file blade.php

            DB::commit();
            return redirect()->route('role.index');
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

    public function edit($id){
        $permissions = $this->permission->all();
        $role = $this->role->findorfail($id);
        $getAllPermissionsOfRole = DB::table('role_permission')->where('role_id',$id)->pluck('permission_id');
        return view('role.edit', compact('permissions','role', 'getAllPermissionsOfRole'));
    }

    public function update(Request $request, $id){
        DB::beginTransaction();
        try {
            //update to role table
            DB::table('role_permission')->where('role_id',$id)->delete();
            $permissionUpdate = $this->role->find($id);
            $permissionUpdate->name = $request->name;
            $permissionUpdate->display_name = $request->display_name;
            $permissionUpdate->permission()->attach($request->permission);

            $permissionUpdate->save();
            DB::commit();
            return redirect()->route('role.index');
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }
}
