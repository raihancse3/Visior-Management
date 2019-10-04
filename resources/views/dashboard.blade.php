@extends('layouts.app_admin')
@section('main')
<div class="row">
    <div class="col-sm-4 col-xs-6">
        <div class="tile-stats tile-red">
            <div class="icon"><i class="entypo-star"></i></div>
            <div class="num" data-start="0" data-end="" data-postfix="" data-duration="1500" data-delay="0">{{$total_user}}</div>
            <h3>Total User</h3>
        </div>
    </div>
    
    <div class="col-sm-4 col-xs-6">
        <div class="tile-stats tile-green">
            <div class="icon"><i class="entypo-chart-bar"></i></div>
            <div class="num" data-start="0" data-end="" data-postfix="" data-duration="1500" data-delay="600">{{$total_visitor}}</div>
            <h3>Total Visitor</h3>
        </div>
    </div>

    <div class="col-sm-4 col-xs-6">
        <div class="tile-stats tile-aqua">
            <div class="icon"><i class="entypo-chart-bar"></i></div>
            <div class="num" data-start="0" data-end="" data-postfix="" data-duration="1500" data-delay="1200">{{$todays_visitor}}</div>
            <h3>
Today's Visitor
            </h3>
        </div>
    </div>

   <!-- <div class="col-sm-4 col-xs-6">
        <div class="tile-stats tile-green">
            <div class="icon"><i class="entypo-chart-bar"></i></div>
            <div class="num" data-start="0" data-end="" data-postfix="" data-duration="1500" data-delay="1200">{{$total_vehicle}}</div>
            <h3>
Total Vehicle
            </h3>
        </div>
    </div>

    <div class="col-sm-4 col-xs-6">
        <div class="tile-stats tile-blue">
            <div class="icon"><i class="entypo-chart-bar"></i></div>
            <div class="num" data-start="0" data-end="" data-postfix="" data-duration="1500" data-delay="1200">{{$total_driver}}</div>
            <h3>
Total Driver
            </h3>
        </div>
    </div>    -->

    <div class="col-sm-4 col-xs-6">
        <div class="tile-stats tile-red">
            <div class="icon"><i class="entypo-star"></i></div>
            <div class="num" data-start="0" data-end="" data-postfix="" data-duration="1500" data-delay="0">{{$todays_visitor}}</div>
            <h3>Today IN</h3>
        </div>
    </div>


    <div class="col-sm-4 col-xs-6">
        <div class="tile-stats tile-aqua">
            <div class="icon"><i class="entypo-chart-bar"></i></div>
            <div class="num" data-start="0" data-end="" data-postfix="" data-duration="1500" data-delay="1200">{{$todays_out}}</div>
            <h3>
Today OUT
            </h3>
        </div>
    </div>
    </div>
@stop