<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\ActivityLog;
use App\EmailSetting;
use DB;
use Session;
use Image;
use Auth;
use Validator;

class EmailSettingController extends Controller
{


    public function index()
    {
        $data['menu'] = 'setting';
        $data['sub_menu'] = 'smtp';
        $data['header'] = 'Smtp Settings';
        $data['smtpInfo'] = EmailSetting::first();
        return view('admin.smtp.index',$data);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'encryption' => 'required',
            'host' => 'required',
            'port' => 'required',
            'email' => 'required|email',
            'username' => 'required|email',
            'password' => 'required',
            'from_address' => 'required|email',
            'from_name' => 'required',
        ]);


            if ($validator->fails()) {
                return redirect('/smtp/setup')
                            ->withErrors($validator)
                            ->withInput();
            }else{
           
            $data       = new EmailSetting;
            $data->encryption = $request->encryption;
            $data->host = $request->host;
            $data->port = $request->port;
            $data->email = $request->email;
            $data->username = $request->username;
            $data->password = $request->password;
            $data->from_address = $request->from_address;
            $data->from_name = $request->from_name;

            $data->save();
        }

        $activityLog = new ActivityLog();
        $activityLog->description = " Smtp setting has been updated.";
        $activityLog->user_id = \Auth::user()->id;
        $activityLog->save();

        Session::flash('message','smtp information updated successfully');
        return redirect()->intended('smtp/setup');
    }

}
