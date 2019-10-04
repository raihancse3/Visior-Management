<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Role;
use App\Permission;
use App\PermissionRole;
use App\Http\Role\Helpers;
use Validator;
use DB;
use Session;

class RoleController extends Controller
{
    public function __construct(){

    }

    public function index()
    {
        $data['menu'] = 'setting';
        $data['sub_menu'] = 'role';
        $data['header']   = 'User Role';
        $data['roles']    = Role::get();
        return view('admin.Role.list',$data);
    }

    public function create()
    {
        $data['menu'] = 'setting';
        $data['sub_menu'] = 'role';
        $data['header']   = 'User Role';
        $data['permissions'] = Permission::get();
        return view('admin.Role.add', $data);
    }


    public function store(Request $request)
    {
            $rules = array(
                    'name'         => 'required|unique:roles',
                    'description'  => 'required'
                    );


            $validator = Validator::make($request->all(),$rules);

            if ($validator->fails()) 
            {
                return back()->withErrors($validator)->withInput();
            }
            else
            {
                $role['name'] = $request->name;
                $role['description'] = $request->description;
                $roleId = Role::insertGetId($role);
                
                if($request->permission)
                    foreach ($request->permission as $key => $value) {
                        PermissionRole::insert(['permission_id' => $value, 'role_id' => $roleId]);
                    }
                Session::flash('success','Information added successfully');
                return redirect('admin/roles');
            }        
    }

    public function edit($id)
    {
        $data['menu'] = 'setting';
        $data['sub_menu'] = 'role';
        $data['header']   = 'User Role';
        $data['role'] = Role::find($id);
        
        $data['permissions'] = Permission::get();
        $result = PermissionRole::where('role_id',$id)
                                    ->pluck('permission_id');

        $data['stored_permissions'] = $result->toArray();
        return view('admin.Role.edit', $data);
    }


    public function update(Request $request)
    {
           
            $rules = array(
                    'name'         => 'required|unique:roles,name,'.$request->id,
                    'description'  => 'required'
                    );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) 
            {
                return back()->withErrors($validator)->withInput(); 
            }
            else
            {
                $role['name'] = $request->name;
                $role['description'] = $request->description;
                Role::where('id',$request->id)->update($role);

                $stored_permissions = PermissionRole::where('role_id',$request->id)
                                        ->pluck('permission_id')
                                        ->toArray();

                $permission = isset($request->permission) ? $request->permission : [];
                if(!empty($stored_permissions)){
                    foreach ($stored_permissions as $key => $value) {
                        if(!in_array($value, $permission))
                            PermissionRole::where(['permission_id' => $value, 'role_id' => $request->id])->delete();
                     
                    }
                }
                if(!empty($permission)){
                    foreach ($permission as $key => $value) {
                        if(!in_array($value, $stored_permissions)){
                            PermissionRole::insert(['permission_id' => $value, 'role_id' => $request->id]);
                            }
                    }
                }
                 Session::flash('success','Information updated successfully');
                return redirect('admin/roles');
            }

        Session::flash('success','Information updated successfully');
        return redirect('admin/roles');
    }

    public function destroy($id)
    {
        Role::where(['id'=>$id])->delete();
        PermissionRole::where(['role_id'=>$id])->delete();
        Session::flash('success','Information deleted successfully');
        return redirect()->intended('admin/roles');

    }
}