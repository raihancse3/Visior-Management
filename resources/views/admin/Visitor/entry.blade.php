@extends('layouts.app_admin')
@section('main')
<div class="row">
      <div class="col-md-12">
        
        <div class="panel panel-primary panel-collapse" data-collapsed="0">
        
          <div class="panel-heading">
            <div class="panel-title">
            Visitor Entry
            </div>
            
            <div class="panel-options">
              <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
              <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
              <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
            </div>
          </div>
          
          <div class="panel-body">
            
            <form role="form" class="form-horizontal form-groups-bordered" action="{{ url('visitor/entry_save') }}" method="post" id="itemAddForm"  enctype="multipart/form-data">
            
            <input type="hidden" value="{{csrf_token()}}" name="_token" id="token"> 
            <input type="hidden" value="{{$visitorInfo->id}}" name="id" id="id">             
              
              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">{{ trans('message.form.name') }}</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" value="{{$visitorInfo->name}}" readonly>
                </div>
              </div>


              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Email/Phone/NID</label>
                <div class="col-sm-5">
                 <input type="email"  class="form-control" value="{{$visitorInfo->username}}" readonly>
                </div>
              </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Card No</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" name="card_no">
                  @if ($errors->has('card_no')) 
                    <p class="text-danger">{{ $errors->first('card_no') }}</p>
                   @endif
                </div>
              </div>
              
              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Purpose</label>
                <div class="col-sm-5">
                 <input type="text"  class="form-control" name="purpose">
                  @if ($errors->has('purpose')) 
                    <p class="text-danger">{{ $errors->first('purpose') }}</p>
                   @endif
                </div>
              </div>              

              <div class="form-group">
                <label class="col-sm-3 control-label">Contract Person</label>
                <div class="col-sm-5">
                        <select class="form-control select2" name="contact_person" id="contact_person">
                        @foreach ($users as $data)
                            @if($data->id !=1)
                            <option value="{{$data->id}}">{{$data->name}} -
                             @if($data->department)
                             {{$data->department->name}}
                             @endif
                           </option>
                            @endif
                        @endforeach
                      </select>
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