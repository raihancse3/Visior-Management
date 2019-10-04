<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Driver;
use App\Vehicle;
use App\VehicleMovement;
use App\User;
use DB;
use Excel;
use Validator;
use Input;
use Session;
use Image;
use Auth;
use QrCode;

class DriverController extends Controller
{
    public function __construct(){

    }

    public function index()
    {
        
        $data['menu'] = 'people';
        $data['header'] = 'Drivers';
        $data['sub_menu'] = 'driver';
        $data['visitors'] = Driver::orderBy('name', 'asc')->get();
        return view('admin.Driver.list', $data);
    }

    public function VehicleMovementList()
    {
        $data['menu'] = '';
        $data['header'] = 'Vehicle Movement List';
        $data['sub_menu'] = 'VehicleMovementList';
        $data['visitors'] = VehicleMovement::orderBy('created_at', 'desc')->get();
        return view('admin.Driver.movementList', $data);
    }
    /**
     * Show the form for creating a new Customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['menu'] = 'people';
        $data['header'] = 'Drivers';
        $data['sub_menu'] = 'driver';
        $data['vehicles'] = Vehicle::orderBy('vehicle_no', 'asc')->get();
        return view('admin.Driver.add', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'emp_id' => 'required|unique:vdrivers,emp_id'
        ]);


        if ($validator->fails()) {
            return redirect('driver/add')
                        ->withErrors($validator)
                        ->withInput();
        }else{
        $data['name'] = $request->name;
        $data['mobile'] = $request->mobile;
        $data['emp_id'] = $request->emp_id;
        $data['vehicle_id'] = $request->vehicle_id;
        $data['added_by'] = Auth::user()->id;

        $pic = $request->file('picture');
        if (isset($pic)) {
          $destinationPath = public_path('/uploads/driver/');
          $filename = time().'.'.$pic->getClientOriginalExtension();
          $img = Image::make($request->file('picture')->getRealPath());
          $img->fit(180,180, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);
          $data['picture'] = $filename;
        }

        Driver::insert($data);

        }
        Session::flash('message','Driver added successfully !');
        return redirect()->intended('drivers');

    }


    public function edit($id)
    {
        $data['menu'] = 'people';
        $data['header'] = 'Drivers';
        $data['sub_menu'] = 'driver';
        $data['driver'] = Driver::find($id);
        $data['vehicles'] = Vehicle::orderBy('vehicle_no', 'asc')->get();
        return view('admin.Driver.edit', $data);
    }


    public function update(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3'
        ]);


        if ($validator->fails()) {
            return redirect('/driver/edit/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }else{

        $data['name'] = $request->name;
        $data['mobile'] = $request->mobile;
        $data['vehicle_id'] = $request->vehicle_id;
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        $pic = $request->file('picture');
        if (isset($pic)) {
          $destinationPath = public_path('/uploads/driver/');
          $filename = time().'.'.$pic->getClientOriginalExtension();
          $img = Image::make($request->file('picture')->getRealPath());
          $img->fit(180,180, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);
          $data['picture'] = $filename;
        }

        Driver::where('id', $id)->update($data);
    }
        Session::flash('message','Driver updated successfully !');
        return redirect()->intended('drivers');
    }

    public function ExitEntry($id)
    {
        $data['menu'] = 'people';
        $data['header'] = 'Driver';
        $data['sub_menu'] = 'driver';
        $data['driver'] = Driver::find($id);
        return view('admin.Driver.exit_entry', $data);
    }

    public function ExitStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'purpose' => 'required',
            'going_to' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/driver/exit_entry/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        }else{

        $data['added_by'] = Auth::user()->id;
        $data['driver_id'] = $request->id;
        $data['vehicle_id'] = $request->vehicle_id;
        $data['type'] = 'OUT';
        $data['purpose'] = $request->purpose;
        $data['going_to'] = $request->going_to;

        VehicleMovement::insert($data);
        $driver = Driver::find($request->id);
        $driver->status = 'OUT';
        $driver->save();
        }
        Session::flash('message','Movement entry successfully !');
        return redirect()->intended('drivers');
    }


    public function ReturnEntry($id)
    {
        $data['menu'] = 'people';
        $data['header'] = 'Driver';
        $data['sub_menu'] = 'driver';
        $data['driver'] = Driver::find($id);
        return view('admin.Driver.return_entry', $data);
    }

    public function ReturnStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'back_from' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/driver/return_entry/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        }else{

        $data['added_by'] = Auth::user()->id;
        $data['driver_id'] = $request->id;
        $data['vehicle_id'] = $request->vehicle_id;
        $data['type'] = 'IN';
        $data['back_from'] = $request->back_from;

        VehicleMovement::insert($data);
        $driver = Driver::find($request->id);
        $driver->status = 'IN';
        $driver->save();
        }
        Session::flash('message','Movement entry successfully !');
        return redirect()->intended('drivers');
    }

    public function makeIdCard($id)
    {
        $data['driver'] = Driver::find($id);
        return view('admin.Driver.card', $data);
    }
}
