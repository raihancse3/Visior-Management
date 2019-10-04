@extends('layouts.app_admin')
@section('main')
<div class="row">
      <div class="col-md-12">
        
        <div class="panel panel-primary panel-collapse" data-collapsed="0">
        
          <div class="panel-heading">
            <div class="panel-title">
            {{ trans('message.form.new_user') }}
            </div>
            
            <div class="panel-options">
              <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
              <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
              <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
            </div>
          </div>
          
          <div class="panel-body">
            
            <form role="form" class="form-horizontal form-groups-bordered" action="{{ url('user/save') }}" method="post" id="itemAddForm"  enctype="multipart/form-data">
            <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">{{ trans('message.form.name') }}</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" name="name" value="{{old('name')}}">
                  @if ($errors->has('name')) 
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                   @endif
                </div>
              </div>


              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">{{ trans('message.list.email') }}</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" name="email" value="{{old('email')}}">
                  @if ($errors->has('email')) 
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                   @endif
                </div>
              </div>


              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Employee Id</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" name="emp_id" value="{{old('emp_id')}}">
                  @if ($errors->has('emp_id')) 
                    <p class="text-danger">{{ $errors->first('emp_id') }}</p>
                   @endif
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mobile No</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" name="mobile" value="{{old('mobile')}}">
                  @if ($errors->has('mobile')) 
                    <p class="text-danger">{{ $errors->first('mobile') }}</p>
                   @endif
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Extension</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" name="extension" value="{{old('extension')}}">
                  @if ($errors->has('extension')) 
                    <p class="text-danger">{{ $errors->first('extension') }}</p>
                   @endif
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">{{ trans('message.form.password') }}</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" name="password" value="{{old('password')}}">
                  @if ($errors->has('password')) 
                    <p class="text-danger">{{ $errors->first('password') }}</p>
                   @endif
                </div>
              </div>              

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">{{ trans('message.form.confirm_password') }}</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}">
                  @if ($errors->has('password_confirmation')) 
                    <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                   @endif
                </div>
              </div> 

              <div class="form-group">
                <label class="col-sm-3 control-label">Department</label>
                <div class="col-sm-5">

                    <select class="form-control" name="department_id" id="department_id" required>
                      <option value="">Select</option>
                    @foreach ($departments as $data)
                      <option value="{{$data->id}}" >{{$data->name}}</option>
                    @endforeach
                    </select>
                  @if ($errors->has('department_id')) 
                  <p class="text-danger">{{ $errors->first('department_id') }}</p>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Section</label>
                <div class="col-sm-5">
                    <select class="form-control" name="section_id" id="section_id" required>
                    </select>
                  @if ($errors->has('section_id')) 
                  <p class="text-danger">{{ $errors->first('section_id') }}</p>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">{{ trans('message.form.role') }}</label>
                <div class="col-sm-5">
                    <select class="form-control" name="role_id" id="role_id">
                    @foreach ($roles as $data)
                      <option value="{{$data->id}}" >{{$data->name}}</option>
                    @endforeach
                    </select>
                  @if ($errors->has('role_id')) 
                  <p class="text-danger">{{ $errors->first('role_id') }}</p>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Picture</label>
                <div class="col-sm-5">
                  <input type="file" name="picture">
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

$(document).ready(function() {

  $("#department_id").on('change', function(){
       var value = $(this).val();
       $.ajax({
           type: "GET",
           url: "{{URL::to('/')}}/get_sections",
           data: {department_id: value},
           success: function (result) {
               if (result != '') {
                   $('#section_id').html(result);
               } else {
                   $('#section_id').html('No Data Found');
               }
           }
       }, "json");
 
  })
});

  </script>
@endsection        