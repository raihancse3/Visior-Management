<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
    
use Illuminate\Http\Request;
use App\Visitor;
use App\VisitorMovement;
use App\Possition;
use App\User;
use DB;
use Excel;
use Validator;
use Input;
use Session;
use Image;
use Auth;

class VisitorController extends Controller
{
    public function __construct(){

    }

    public function index()
    {
        $data['menu'] = 'people';
        $data['header'] = 'Visitors';
        $data['sub_menu'] = 'visitor';

        $data['visitors'] = Visitor::orderBy('name', 'asc')->get();
        $data['from'] = null;
        $data['to'] = null;
        if( !empty($_GET['from']) && !empty($_GET['to'])){
            $from = date('Y-m-d', strtotime($_GET['from']));
            $to = date('Y-m-d', strtotime($_GET['to']));

            $data['visitors'] = Visitor::whereBetween('created_at', [$from, $to])
                                ->orderBy('name', 'asc')
                                ->get();

             $data['from'] = $_GET['from'];
             $data['to'] = $_GET['to'];                    

        }


        
        return view('admin.Visitor.list', $data);
    }

    public function movementList()
    {
        $data['menu'] = '';
        $data['header'] = 'Visitor Movement List';
        $data['sub_menu'] = 'movementList';
    
        if(Auth::user()->role_id == 1){
          $data['visitors'] = VisitorMovement::orderBy('created_at', 'desc')->get();
        }else{
          $data['visitors'] = VisitorMovement::where('contact_person',Auth::user()->id)->orderBy('created_at', 'desc')->get();  
        }

        return view('admin.Visitor.movementList', $data);
    }

    /**
     * Show the form for creating a new Customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['menu'] = 'people';
        $data['header'] = 'Visitor';
        $data['sub_menu'] = 'visitor';
        $data['possitions'] = Possition::get();

        return view('admin.Visitor.add', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'username' => 'required|unique:visitors,username'
        ]);


        if ($validator->fails()) {
            return redirect('visitor/add')
                        ->withErrors($validator)
                        ->withInput();
        }else{
        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['gender'] = $request->gender;
       
        $data['company_name'] = $request->company_name;
        $data['company_address'] = $request->company_address;
        $data['possition_id'] = $request->possition_id;
        $data['added_by'] = Auth::user()->id;

        $pic = $request->file('picture');
        if (isset($pic)) {
          $destinationPath = public_path('/uploads/visitor/');
          $filename = time().'.'.$pic->getClientOriginalExtension();
          $img = Image::make($request->file('picture')->getRealPath());
          $img->fit(180,180, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);
          $data['picture'] = $filename;
        }

        Visitor::insert($data);

        }
        Session::flash('message','Visitor added successfully !');
        return redirect()->intended('visitors');

    }

    public function edit($id)
    {
        $data['menu'] = 'people';
        $data['header'] = 'Visitor';
        $data['sub_menu'] = 'visitor';
        $data['possitions'] = Possition::get();
         $data['visitor'] = Visitor::find($id);
        return view('admin.Visitor.edit', $data);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'username' => 'required|unique:visitors,username,' . $request->id, 
        ]);

        $id = $request->id;
        if ($validator->fails()) {
            return redirect('visitor/edit/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }else{
        
        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['gender'] = $request->gender;
        $data['company_name'] = $request->company_name;
        $data['company_address'] = $request->company_address;
        $data['possition_id'] = $request->possition_id;

        $pic = $request->file('picture');
        if (isset($pic)) {
          $destinationPath = public_path('/uploads/visitor/');
          $filename = time().'.'.$pic->getClientOriginalExtension();
          $img = Image::make($request->file('picture')->getRealPath());
          $img->fit(180,180, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);
          $data['picture'] = $filename;
        }

       
        Visitor::where('id', $id)->update($data);

        }
        Session::flash('message','Visitor update successfully !');
        return redirect()->intended('visitors');

    }

    public function GetExit($id)
    {
        $entryInfo = VisitorMovement::where(['visitor_id'=>$id,'type'=>'In'])->orderBy('id','desc')->first();
        
        $data['visitor_id'] = $id;
        $data['type'] = 'Out';
        $data['card_no'] = $entryInfo->card_no;
        $data['added_by'] = Auth::user()->id;

        VisitorMovement::insert($data);

        $visitor = Visitor::find($id);
        $visitor->status = 'Out';
        $visitor->save();

        Session::flash('message','Visitor exit successfully !');
        return redirect()->intended('visitors');
    }

    public function viewDetail($id)
    {
        $data['menu'] = 'people';
        $data['header'] = 'Supplier';
        $data['sub_menu'] = 'supplier';
        $data['supplierInfo'] = Supplier::find($id);
        return view('admin.supplier.detail', $data);
    }
    
    public function GetEntry($id)
    {
        $data['menu'] = 'people';
        $data['header'] = 'Visitor';
        $data['sub_menu'] = 'visitor';
        $data['visitorInfo'] = Visitor::find($id);
        $data['users'] = User::get();
        return view('admin.Visitor.entry', $data);
    }

    public function EntryStore(Request $request)
    {

        
        $validator = Validator::make($request->all(), [
            'purpose' => 'required',
            'contact_person' => 'required',
            'card_no' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/visitor/entry/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        }else{

        $data['added_by'] = Auth::user()->id;
        $data['visitor_id'] = $request->id;
        $data['type'] = 'In';
        $data['purpose'] = $request->purpose;
        $data['card_no'] = $request->card_no;
        $data['contact_person'] = $request->contact_person;

        VisitorMovement::insert($data);

        $visitor = Visitor::find($request->id);
        $visitor->status = 'In';
        $visitor->save();

    }
        Session::flash('message','Visitor entry successfully !');
        return redirect()->intended('visitors');
    }

    public function makeIdCard($id)
    {
        $data['visitor'] = Visitor::find($id);
        return view('admin.Visitor.card', $data);
    }

}
