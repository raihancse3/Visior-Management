@extends('layouts.app_admin')
@section('main')
  @if (Session::has('message'))
  <div class="alert alert-info">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> {{ Session::get('message') }}.
  </div>
  @endif
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">{{ trans('message.menu.site_settings') }}</div>
        <div class="panel-options">
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
          <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
          <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
      </div>
    <div class="panel-body">
      <form action="{{ url('setting/store') }}" method="post" class="form-horizontal form-groups-bordered">
        {!! csrf_field() !!}
           
              <div class="form-group">
                <label class="col-sm-3 control-label require" for="inputEmail3">{{ trans('message.form.site_name') }}</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="name" value="{{ isset( $setting->name ) ? $setting->name :'' }}" >

              @if($errors->has('name'))
              <p class="text-danger">{{ $errors->first('name') }}</p>
              @endif
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label require" for="inputEmail3">{{ trans('message.list.email') }}</label>
                <div class="col-sm-5">
                  <input type="email" class="form-control" name="email" value="{{ isset( $setting->email ) ? $setting->email :'' }}" >
              @if($errors->has('email'))
              <p class="text-danger">{{ $errors->first('email') }}</p>
              @endif
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label require" for="inputEmail3">{{ trans('message.list.phone') }}</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="phone" value="{{ isset( $setting->phone ) ? $setting->phone :'' }}" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="inputEmail3">Currency</label>
                <div class="col-sm-5">
                  <select class="form-control" name="currency_id" required>
                    
                    @foreach ($currencies as $data)
                    <option value="{{$data->id}}" <?= isset($setting->currency_id) && ($setting->currency_id == $data->id) ? 'selected':""?> >{{$data->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label" for="inputEmail3">{{ trans('message.form.default_language') }}</label>
                <div class="col-sm-5">
                  <select name="language" class="form-control" >
                    @foreach($languages as $res)
                    <option value="{{$res->code}}" <?= isset($setting->language) && ($setting->language == $res->code) ? 'selected':""?> >{{$res->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
           
              <div class="form-group">
                <label class="col-sm-3 control-label require" for="inputEmail3">{{ trans('message.form.street') }}</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="street" value="{{ isset( $setting->street ) ? $setting->street :'' }}" >
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label require" for="inputEmail3">{{ trans('message.form.city') }}</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="city" value="{{ isset( $setting->city ) ? $setting->city :'' }}" >
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label require" for="inputEmail3">{{ trans('message.form.state') }}</label>
                <div class="col-sm-5">
                  <input id="state" type="text" class="form-control" name="state" value="{{ isset( $setting->state ) ? $setting->state :'' }}">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label" for="inputEmail3">{{ trans('message.form.zipcode') }}</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="zipcode" value="{{ isset( $setting->zipcode ) ? $setting->zipcode :'' }}" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label require" for="inputEmail3">{{ trans('message.form.country') }}</label>
                <div class="col-sm-5">
                  <select class="form-control" name="country_id" id="country_id" required>
                    
                    @foreach ($countries as $data)
                    <option value="{{$data->id}}" <?= isset($setting->country_id) && ($setting->country_id == $data->id) ? 'selected':""?> id="{{$data->id}}">{{$data->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              



          <div class="form-group">
            <label class="col-sm-3 control-label" for="inputEmail3"></label>
            <div class="col-sm-5">
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