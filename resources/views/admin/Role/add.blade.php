@extends('layouts.app_admin')
@section('main')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      
      <div class="panel-heading">
        <div class="panel-title">{{ trans('message.list.new_role') }}</div>
        <div class="panel-options">
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
          <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
          <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
       </div> 
        <div class="panel-body">
          <form action="{{ url('admin/role/save') }}" method="post" id="addRole" class="form-horizontal">
            <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
            
            <div class="form-group">
              <label for="input_name" class="col-sm-2 control-label required">{{ trans('message.list.name') }}</label>
              <div class="col-sm-8">
                <input type="text" name="name" placeholder="Name" id="name" class="form-control">
                <span class="text-danger">{{ $errors->first('name') }}</span>
              </div>
            </div>
            <div class="form-group">
              <label for="input_description" class="col-sm-2 control-label required">{{ trans('message.list.description') }}</label>
              <div class="col-sm-8">
                <input type="text" name="description" placeholder="Description" id="description" class="form-control">
                <span class="text-danger">{{ $errors->first('description') }}</span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-2 control-label">{{ trans('message.list.permission') }}</label>
              <div class="col-sm-8">
                <ul style="display: inline-block;list-style-type: none;padding:0; margin:0;">
                  @foreach($permissions as $row)
                  
                  <li class="checkbox" style="display: inline-block; min-width: 120px;">
                    <label>
                      <input type="checkbox" name="permission[]" value="{{ $row->id }}">
                      {{ $row->description }}
                    </label>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
            
            <div class="box-footer">
              <a href="{{ url('admin/roles') }}" class="btn btn-info btn-flat">{{ trans('message.form.cancel') }}</a>
              <button class="btn btn-primary btn-flat pull-right" type="submit">{{ trans('message.form.submit') }}</button>
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