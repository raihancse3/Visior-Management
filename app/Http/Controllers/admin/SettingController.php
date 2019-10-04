<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ActivityLog;
use App\Country;
use App\Currency;
use App\Setting;
use App\Language;
use DB;
use Session;
use Image;
use Auth;
use Validator;

class SettingController extends Controller
{

    public function index()
    {
        $data['menu'] = 'setting';
        $data['sub_menu'] = 'company';
        $data['header'] = 'Settings';
        $data['countries'] = Country::get();
        $data['currencies'] = Currency::get();
        $data['languages'] = Language::get();
       
        $data['setting'] = Setting::find(1);

        return view('admin.setting.index',$data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|',
            'email' => 'required|email',
        ]);


            if ($validator->fails()) {
                return redirect('/settings')
                            ->withErrors($validator)
                            ->withInput();
            }else{
            
            $sessionInfo = $request->all();
            unset($sessionInfo['_token']);
           
            $data       = Setting::find(1);
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->currency_id = $request->currency_id;
            $data->language = $request->language;
            $data->street = $request->street;
            $data->city = $request->city;
            $data->state = $request->state;
            $data->zipcode = $request->zipcode;
            $data->country_id = $request->country_id;
            $data->save();
        }
        

        //////////////////////Session Update//////////////////            
           
            Session::put($sessionInfo);
            
            $info = Currency::find($request->currency_id);
            $currency['currency_name'] = $info->name;
            $currency['currency_symbol'] = $info->symbol;
            Session::put($currency);
            //////////////////////Session Update//////////////////

        $activityLog = new ActivityLog();
        $activityLog->description = " Site setting has been updated.";
        $activityLog->user_id = \Auth::user()->id;
        $activityLog->save();

            Session::flash('message','Settings updated successfully');
            return redirect()->intended('settings');
    }


}
