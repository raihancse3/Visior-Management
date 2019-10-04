<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Department;
use App\Section;
use App\User;
use DB;
use Session;
use Validator;

class DepartmentController extends Controller
{
    public function __construct(){
        
    }

    public function index()
    {
        $data['menu'] = 'setting';
        $data['sub_menu'] = 'department';
        $data['header'] = 'Department';
        $data['departments'] = Department::orderBy('name', 'asc')->get();
        return view('admin.department.list', $data);
    }


    public function create()
    {
        $data['menu'] = 'setting';
        $data['sub_menu'] = 'department';
        $data['header'] = 'Department';
        return view('admin.department.add', $data);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
        ]);


        if ($validator->fails()) {
            return redirect('/department/add')
                        ->withErrors($validator)
                        ->withInput();
        }else{
        $data       = new Department;
        $data->name = $request->name;
        $data->save();
    }
        Session::flash('message','Department added successfully !');
        return redirect()->intended('departments');

    }


    public function edit($id)
    {
        $data['menu'] = 'setting';
        $data['sub_menu'] = 'department';
        $data['header'] = 'Department';
        $data['department'] = Department::find($id);
        
        return view('admin.department.edit', $data);
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3' 
        ]);

        $id = $request->id;
        if ($validator->fails()) {
            return redirect('/department/edit/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }else{
        $data =     Department::find($id);
        $data->name = $request->name;
        $data->save();
    }

        Session::flash('message','Department updated successfully !');
        return redirect()->intended('departments');
    }

    public function sectionList($id)
    {
        $data['menu'] = 'setting';
        $data['sub_menu'] = 'department';
        $data['header'] = 'Department|Section';
        $data['sections'] = Section::where('department_id', $id)->get();
        $data['department'] = Department::find($id);
        return view('admin.section.list', $data);
    }

    public function sectionAdd($id)
    {
        $data['menu'] = 'setting';
        $data['sub_menu'] = 'department';
        $data['header'] = 'Department|Section';
        $data['department'] = Department::find($id);
        return view('admin.section.add', $data);
    }    


    public function sectionStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
        ]);


        if ($validator->fails()) {
            return redirect("/section/add/$request->department_id")
                        ->withErrors($validator)
                        ->withInput();
        }else{
        $data       = new Section;
        $data->name = $request->name;
        $data->department_id = $request->department_id;
        $data->save();
    }
        Session::flash('message','Section added successfully !');
        return redirect()->intended("sections/$request->department_id");

    }

    public function sectionEdit($did,$sid)
    {
        $data['menu'] = 'setting';
        $data['sub_menu'] = 'department';
        $data['header'] = 'Department|Section';
        $data['department'] = Department::find($did);
        $data['section'] = Section::find($sid);
        return view('admin.section.edit', $data);
    } 

    public function sectionUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3' 
        ]);

        $did = $request->did;
        $sid = $request->sid;
        if ($validator->fails()) {
            return redirect('/section_edit/'.$id.'/'.$sid)
                        ->withErrors($validator)
                        ->withInput();
        }else{
        $data =     Section::find($sid);
        $data->name = $request->name;
        $data->save();
    }

        Session::flash('message','Section updated successfully !');
        return redirect()->intended('sections/'.$did);
    }

    public function sectionDelete($id)
    {

        $section= Section::find($id);
        $section->delete();
        Session::flash('message','Section deleted successfully !');
        return redirect()->intended('sections/'.$id);
    }

    public function departDelete($id)
    {
        $check = User::where('department_id',$id)->get();

        if($check){
            Session::flash('message','Department can not be deleted successfully !');
            return redirect()->intended('departments');
        }
        
        $section= Department::find($id);
        $section->delete();
        DB::table('sections')->where(['department_id'=>$id])->delete();
        Session::flash('message','Department deleted successfully !');
        return redirect()->intended('departments');
    }

    public function sectionListByDept(Request $request){
        $did = $_GET['department_id'];
        $sections = Section::where('department_id',$did)->get();

        $drops = '';
        foreach ($sections as $key => $value) {
            $drops .='<option value="'.$value->id.'">'.$value->name.'</option>';
        }

        echo $drops;
    }
}
