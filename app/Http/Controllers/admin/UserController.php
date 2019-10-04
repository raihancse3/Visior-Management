<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Session;
use Validator;
use Hash;
use App\Department;
use App\Section;
use App\User;
use App\RoleUser;
use App\Role;
use Image;

class UserController extends Controller
{

    public function index()
    {
        $id = Auth::user()->id;
        $data['menu'] = 'people';
        $data['sub_menu'] = 'user';
        $data['header'] = 'User';
        $data['userList'] = User::get();
        return view('admin.user.list', $data);
    }


    public function create()
    {
        $data['menu'] = 'people';
        $data['sub_menu'] = 'user';
        $data['header'] = 'User';
        $data['roles'] = Role::get();
        $data['departments'] = Department::get();
        
        return view('admin.user.add', $data);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'role_id'=>'required',
            'password' => 'min:3|required',
            'password_confirmation' => 'min:3|same:password'
        ]);


        if ($validator->fails()) {
            return redirect('/user/add')
                        ->withErrors($validator)
                        ->withInput();
        }else{
        
        $data['name'] = $request->name;
        $data['email'] = trim($request->email);
        $data['emp_id'] = $request->emp_id;
        $data['mobile'] = $request->mobile;
        $data['extension'] = $request->extension;
        $data['password'] = Hash::make(trim($request->password));
        $data['role_id'] = $request->role_id;
        $data['department_id'] = $request->department_id;
        $data['section_id'] = $request->section_id;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['added_by'] = Auth::user()->id;

        $pic = $request->file('picture');
        if (isset($pic)) {
          $destinationPath = public_path('/uploads/user/');
          $filename = time().'.'.$pic->getClientOriginalExtension();
          $img = Image::make($request->file('picture')->getRealPath());
          $img->fit(180,180, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);
          $data['picture'] = $filename;
        }

        $uid = User::insertGetId($data);




        $userRole['user_id'] = $uid;
        $userRole['role_id'] = $request->role_id;

        RoleUser::insert($userRole);

        Session::flash('message','user added successfully !');
        return redirect()->intended("user/list");
        }

        

    }


    public function edit($id)
    {
        $data['menu'] = 'people';
        $data['sub_menu'] = 'user';
        $data['header'] = 'User';
        $data['userData'] = User::find($id);
        $data['roles'] = Role::get();
        return view('admin.user.edit', $data);
    }


    public function update(Request $request)
    {
       
       $id = $request->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'role_id'=>'required'
        ]);


        if ($validator->fails()) {
            return redirect('/user/edit'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }else{
        
        $data['name'] = $request->name;
        $data['role_id'] = $request->role_id;
        $data['emp_id'] = $request->emp_id;
        $data['mobile'] = $request->mobile;
        $data['extension'] = $request->extension;
       

        if(!empty($request->password) && !empty($request->confirm_password)){
            $data['password'] = Hash::make($request->password);
            if($request->password!=$request->confirm_password){
            return back()->withInput()->withErrors(['confirm_password' => "Password not matching !"]);
            }
        }

        $pic = $request->file('picture');
        if (isset($pic)) {
          $destinationPath = public_path('/uploads/user/');
          $filename = time().'.'.$pic->getClientOriginalExtension();
          $img = Image::make($request->file('picture')->getRealPath());
          $img->fit(180,180, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);
          $data['picture'] = $filename;
        }

        User::where('id', $id)->update($data);

        $userRole['role_id'] = $request->role_id;
        RoleUser::where(['user_id'=>$id])->update($userRole);

        Session::flash('message','user updated successfully !');
        return redirect()->intended("user/list");
        }

    }



    public function currentUser()
    {
        $id = Auth::user()->id;
        $data['menu'] = 'people';
        $data['sub_menu'] = 'user';
        $data['header'] = 'user';
        $data['userData'] = User::find($id);
        return view('admin.user.edit_current_user', $data);
    }
    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3'
        ]);


        if ($validator->fails()) {
            return redirect('/edit/current-user')
                        ->withErrors($validator)
                        ->withInput();
        }else{
        
        $data['name'] = $request->name;
        $data['updated_at'] = date('Y-m-d H:i:s');

        if(!empty($request->password) && !empty($request->password_confirmation)){
            $data['password'] = Hash::make($request->password);
            if($request->password!=$request->password_confirmation){
            return back()->withInput()->withErrors(['confirm_password' => "Password not matching !"]);
            }
        }

        User::where('id', $id)->update($data);

        Session::flash('message','Profile updated successfully !');
        return redirect()->intended("/edit/current-user");
        }

    }

    public function destroy($id)
    {
      
      User::where('id', $id)->delete();
      RoleUser::where('user_id', $id)->delete();
      Session::flash('message','user deleted successfully !');
      return redirect()->intended("user/list");
    }

    public function viewDetail($id){
        $data['menu'] = 'people';
        $data['sub_menu'] = 'user';
        $data['header'] = 'user';  
        $data['user'] = User::find($id);
        return view('admin.user.detail', $data);   
    }


}
