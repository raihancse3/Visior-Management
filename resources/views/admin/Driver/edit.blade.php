@extends('layouts.app_admin')
@section('main')
<div class="row">
      <div class="col-md-12">
        
        <div class="panel panel-primary panel-collapse" data-collapsed="0">
        
          <div class="panel-heading">
            <div class="panel-title">
           Driver
            </div>
            
            <div class="panel-options">
              <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
              <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
              <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
            </div>
          </div>
          
          <div class="panel-body">
            
            <form role="form" class="form-horizontal form-groups-bordered" action="{{ url('driver/update') }}" method="post" id="itemAddForm"  enctype="multipart/form-data">
            
            <input type="hidden" value="{{csrf_token()}}" name="_token" id="token"> 
            <input type="hidden" value="{{$driver->id}}" name="id" id="id">             
              
              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">{{ trans('message.form.name') }}</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" name="name" value="{{$driver->name}}">
                  @if ($errors->has('name')) 
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                   @endif
                </div>
              </div>


              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mobile</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" name="mobile" value="{{$driver->mobile}}">
                  @if ($errors->has('mobile')) 
                    <p class="text-danger">{{ $errors->first('mobile') }}</p>
                   @endif
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Employee ID</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" value="{{$driver->emp_id}}" readonly>
                  @if ($errors->has('emp_id')) 
                    <p class="text-danger">{{ $errors->first('emp_id') }}</p>
                   @endif
                </div>
              </div>              

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Vehicle</label>
                <div class="col-sm-5">
                <select class="form-control" name="vehicle_id" id="vehicle_id">
                  @foreach($vehicles as $vehicle)
                  <option value="{{$vehicle->id}}" <?= ($vehicle->id==$driver->vehicle_id) ? 'selected':'' ?> >{{$vehicle->vehicle_no}}</option>
                 @endforeach
                </select>
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

  </script>
@endsection        