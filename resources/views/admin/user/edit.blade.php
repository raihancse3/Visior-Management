@extends('layouts.app_admin')
@section('main')
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
            
            <form role="form" class="form-horizontal form-groups-bordered" action="{{ url('user/update') }}" method="post" id="itemAddForm"  enctype="multipart/form-data">
            <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
            <input type="hidden" name="id" value="{{$userData->id}}">
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
                 <input type="text"  class="form-control" name="email" value="{{$userData->email}}" readonly>
                  @if ($errors->has('email')) 
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                   @endif
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Employee Id</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" name="emp_id" value="{{$userData->emp_id}}">
                  @if ($errors->has('emp_id')) 
                    <p class="text-danger">{{ $errors->first('emp_id') }}</p>
                   @endif
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mobile No</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" name="mobile" value="{{$userData->mobile}}">
                  @if ($errors->has('mobile')) 
                    <p class="text-danger">{{ $errors->first('mobile') }}</p>
                   @endif
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Extension</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" name="extension" value="{{$userData->extension}}">
                  @if ($errors->has('extension')) 
                    <p class="text-danger">{{ $errors->first('extension') }}</p>
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
                <label class="col-sm-3 control-label">{{ trans('message.form.role') }}</label>
                <div class="col-sm-5">
                    <select class="form-control" name="role_id" id="role_id">
                    @foreach ($roles as $data)
                      <option value="{{$data->id}}" <?= ($data->id==$userData->role_id) ? 'selected' : '' ?>>{{$data->name}}</option>
                    @endforeach
                    </select>
                  @if ($errors->has('role_id')) 
                  <p class="text-danger">{{ $errors->first('role_id') }}</p>
                  @endif

                </div>
              </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">{{ trans('message.list.image') }}</label>

          <div class="col-sm-5">
            <input type="file" name="picture" class="form-control input-file-field">
           
          </div>
        </div>


              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-5">
                  <button class="btn btn-primary pull-right btn-flat" type="submit">{{ trans('message.form.submit') }}</button>
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