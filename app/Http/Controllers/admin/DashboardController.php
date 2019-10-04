<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use App\User;
use App\Dashboard;
use App\VisitorMovement;
use App\Vehicle;
use App\Driver;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct( Dashboard $dashboard){
        $this->dashboard = $dashboard;
    }


    public function index()
    {   
        $data['menu'] = 'dashboard';
        $data['sub_menu'] = 'dashboard';
        $data['header'] = 'Dashboard';

        $data['total_user'] = User::count();
        $data['total_visitor'] = VisitorMovement::where('type','In')->count();
        $data['todays_visitor'] = VisitorMovement::where('type','In')->whereDate('created_at', DB::raw('CURDATE()'))->count();
        $data['total_driver'] = Driver::count();
        $data['total_vehicle'] = Vehicle::count();

        $data['todays_out'] = VisitorMovement::where('type','Out')->whereDate('created_at', DB::raw('CURDATE()'))->count();

        return view('dashboard', $data);
    }

    public function changeLanguage(Request $request)
    {

        if ($request->lang) {
            \Session::put('language', $request->lang);
            \App::setLocale($request->lang);
            echo 1;
        } else {
            echo 0;
        }

    }

}
