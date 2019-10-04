@extends('layouts.app_admin')
@section('main')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">Edit Department</div>
        <div class="panel-options">
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
          <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
          <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
      </div>
      
      <div class="panel-body">
        <form action="{{ url('department/update') }}" method="post" id="locationAdd" class="form-horizontal form-groups-bordered">
          <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
          <input type="hidden" class="form-control" name="id" value="{{$department->id}}">
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">Name</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="name" value="{{$department->name}}">
              @if ($errors->has('name'))
              <p class="text-danger">{{ $errors->first('name') }}</p>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="inputEmail3"></label>
            <div class="col-sm-5">
              <a href="{{ url('departments') }}" class="btn btn-info">{{ trans('message.form.cancel') }}</a>
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