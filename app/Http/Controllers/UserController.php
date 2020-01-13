<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private $user;
    private $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index()
    {

        $listUser = $this->user->all();
        return view('user.index', compact('listUser'));
    }

    public function create()
    {
        $roles = $this->role->all();
        return view('user.add', compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            // insert data đến bảng user table

            $fileName = $request->file('fileToUpload')->getClientOriginalName();

            $request->file('fileToUpload')->storeAs('logos',$fileName);
            $userCreate = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'image' => $fileName,
                'password' => Hash::make($request->password),
            ]);

            // insert qua relationship eloquence
            $userCreate->roles()->attach($request->roles);
            // insert data to role user Cach 2: insert binh thuong
//            $roles = $request->roles;
//            foreach ($roles as $roleId) {
//                DB::table('role_user')->insert(
//                    [
//                        'user_id' => $userCreate->id,
//                        'role_id' => $roleId
//                    ]
//                );
//            }
            DB::commit();
            return redirect()->route('user.index');
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

    /**
     * @param $id
     * Show form edit
     */
    public function edit($id){
        $roles = $this->role->all();
        $user = $this->user->findorfail($id);
        $listRolesUser = DB::table('role_user')->where('user_id',$id)->pluck('role_id');
        return view('user.edit',compact('roles','user', 'listRolesUser'));
    }

    public function update(Request $request, $id){
        DB::beginTransaction();
        try {
            DB::table('role_user')->where('user_id',$id)->delete();
            $userUpdate = $this->user->find($id);
            $userUpdate->name = $request->name;
            $userUpdate->email = $request->email;
            $userUpdate->roles()->attach($request->roles);

            $userUpdate->save();
            DB::commit();
            return redirect()->route('user.index');
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }
    public function delete(Request $request, $id){
        DB::beginTransaction();
        try {
            DB::table('role_user')->where('user_id',$id)->delete();
            $userUpdate = $this->user->find($id);
            $userUpdate->name = $request->name;
            $userUpdate->email = $request->email;
            $userUpdate->roles()->attach($request->roles);

            $userUpdate->save();
            DB::commit();
            return redirect()->route('user.index');
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }
    public function destroy($id){
        dd(123);
    }
}
