@extends('layouts.app_admin')
@section('main')
<div class="row">
      <div class="col-md-12">
        
        <div class="panel panel-primary panel-collapse" data-collapsed="0">
        
          <div class="panel-heading">
            <div class="panel-title">
            New Visitor
            </div>
            
            <div class="panel-options">
              <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
              <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
              <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
            </div>
          </div>
          
          <div class="panel-body">
            
            <form role="form" class="form-horizontal form-groups-bordered" action="{{ url('visitor/update') }}" method="post" id="itemAddForm"  enctype="multipart/form-data">
            
            <input type="hidden" value="{{csrf_token()}}" name="_token" id="token"> 
            <input type="hidden" value="{{$visitor->id}}" name="id">              
              
              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Visitor Name</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" name="name" value="{{ $visitor->name }}">
                  @if ($errors->has('name')) 
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                   @endif
                </div>
              </div>


              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mobile/Email/NID</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" name="username" value="{{$visitor->username}}">
                  @if ($errors->has('username')) 
                    <p class="text-danger">{{ $errors->first('username') }}</p>
                   @endif
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Company Name</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" name="company_name" value="{{$visitor->company_name}}">
                  @if ($errors->has('company_name')) 
                    <p class="text-danger">{{ $errors->first('company_name') }}</p>
                   @endif
                </div>
              </div>              


              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Company Address</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" name="company_address" value="{{$visitor->company_address}}">
                  @if ($errors->has('company_address')) 
                    <p class="text-danger">{{ $errors->first('company_address') }}</p>
                   @endif
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Possition</label>
                <div class="col-sm-5">
                <select class="form-control" name="possition_id" id="possition_id">
                  @foreach($possitions as $val)
                  <option value="{{$val->id}}" <?= ($val->id == $visitor->possition_id) ? 'selected':''?> >{{$val->name}}</option>
                  @endforeach
                </select>
                </div>
              </div> 




              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Gender</label>
                <div class="col-sm-5">
                <select class="form-control" name="gender" id="gender">
                  <option value="Male" <?= ('Male' == $visitor->gender) ? 'selected':''?>>Male</option>
                  <option value="Female" <?= ('Female' == $visitor->gender) ? 'selected':''?>>Female</option>
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