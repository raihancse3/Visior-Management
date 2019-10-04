@extends('layouts.app_admin')
@section('main')
<div class="row">
  <div class="col-md-12">
    @if (Session::has('message'))
    <div class="alert alert-info">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {{ Session::get('message') }}
    </div>
    @endif
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <!-- panel head -->
      <div class="panel-heading">
        <div class="panel-title">Smtp</div>
        <div class="panel-options">
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
          <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
          <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
      </div>
      
      <div class="panel panel-body">
        <form action="{{ url('smtp/store') }}" method="post" id="smtp" class="form-horizontal form-groups-bordered">
          <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
          
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">{{ trans('message.form.from_email')}}</label>
            <div class="col-sm-6">
              <input type="email" value="{{isset($smtpInfo->from_address) ? $smtpInfo->from_address : ''}}" class="form-control" name="from_address" required>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">{{ trans('message.form.from_name')}}</label>
            <div class="col-sm-6">
              <input type="text" value="{{isset($smtpInfo->from_name) ? $smtpInfo->from_name : ''}}" class="form-control" name="from_name" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">{{ trans('message.form.smtp_encription')}}</label>
            <div class="col-sm-6">
              <input type="text" value="{{isset($smtpInfo->encryption) ? $smtpInfo->encryption : ''}}" class="form-control" name="encryption" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">{{ trans('message.form.smtp_host')}}</label>
            <div class="col-sm-6">
              <input type="text" value="{{isset($smtpInfo->host) ? $smtpInfo->host : ''}}" class="form-control" name="host" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">{{ trans('message.form.smtp_port')}}</label>
            <div class="col-sm-6">
              <input type="text" value="{{isset($smtpInfo->port) ? $smtpInfo->port : ''}}" class="form-control" name="port" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">{{ trans('message.form.smtp_email')}}</label>
            <div class="col-sm-6">
              <input type="email" value="{{isset($smtpInfo->email) ? $smtpInfo->email : ''}}" class="form-control" name="email" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">{{ trans('message.form.smtp_username')}}</label>
            <div class="col-sm-6">
              <input type="email" value="{{isset($smtpInfo->username) ? $smtpInfo->username : ''}}" class="form-control" name="username" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">{{ trans('message.form.password')}}</label>
            <div class="col-sm-6">
              <input type="password" value="{{isset($smtpInfo->password) ? $smtpInfo->password : ''}}" class="form-control" name="password" required>
            </div>
          </div>
        
          <div class="form-group">
            <label class="col-sm-3 control-label" for="inputEmail3"></label>
            <div class="col-sm-6">
              <button class="btn btn-primary pull-right" type="submit">{{ trans('message.form.submit') }}</button>
            </div>
          </div>
        
        </form>
      </div>
    </div>
  </div>
    </div>
  @endsection
  @section('js')
  <script type="text/javascript">
  
  
  </script>
  @endsection