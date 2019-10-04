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
        
        <div class="panel panel-primary panel-collapse" data-collapsed="0">
        
          <div class="panel-heading">
            <div class="panel-title">
            {{ trans('message.form.edit_user') }}
            </div>
            
            <div class="panel-options">
              <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
              <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
              <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
            </div>
          </div>
          
          <div class="panel-body">
            
            <form role="form" class="form-horizontal form-groups-bordered" action="{{ url('user/update-profile') }}" method="post" id="itemAddForm"  enctype="multipart/form-data">
            <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">{{ trans('message.form.name') }}</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" name="name" value="{{$userData->name}}">
                  @if ($errors->has('name')) 
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                   @endif
                </div>
              </div>


              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">{{ trans('message.list.email') }}</label>
                <div class="col-sm-5">
                 <input type="email" value="{{$userData->email}}" class="form-control" id="email" name="email" readonly>
                  @if ($errors->has('email')) 
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                   @endif
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">{{ trans('message.form.new_password') }}</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" name="password">
                  @if ($errors->has('password')) 
                    <p class="text-danger">{{ $errors->first('password') }}</p>
                   @endif
                </div>
              </div>              


              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">{{ trans('message.form.confirm_password') }}</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" name="password_confirmation">
                  @if ($errors->has('confirm_password')) 
                    <p class="text-danger">{{ $errors->first('confirm_password') }}</p>
                   @endif
                </div>
              </div> 

              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-5">
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