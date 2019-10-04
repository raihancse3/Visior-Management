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
      
      <div class="panel-heading">
        <div class="panel-title">{{ trans('message.list.user_roles') }}</div>
        <div class="panel-options">
        @if(Helpers::has_permission(Auth::user()->id, 'add_role'))
          <a href="{{ url('admin/role/add') }}" class="bg"><span class="fa fa-plus"> &nbsp;</span>{{ trans('message.list.new_role') }}</a>
          @endif
        
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
          <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
          <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
      </div>

        <div class="panel-body">
          
<table id="list" class="table table-bordered text-center">
          <thead>
            <tr>
              <th class="text-center">ID</th>
              <th class="text-center">{{ trans('message.list.name') }}</th>
              <th class="text-center">{{ trans('message.list.description') }}</th>
              <th class="text-center">{{ trans('message.list.action') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($roles as $data)
            <tr">
              <td>{{ $data->id }}</td>
              <td>{{ $data->name }}</td>
              <td>{{ $data->description }}</td>
              <td>
              @if(Helpers::has_permission(Auth::user()->id, 'edit_role'))
                <a title="{{ trans('message.form.edit') }}" class="btn btn-xs btn-primary" href='{{ url("admin/role/edit/$data->id") }}'><i class="glyphicon glyphicon-edit"></i></a> &nbsp;
               @endif

               @if(Helpers::has_permission(Auth::user()->id, 'delete_role'))
                @if(!in_array($data->id,[1]))
                <a href="{{url('admin/role/delete/'.$data->id)}}" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete?')"></i></a> 
                @endif
               @endif
              </td>
            </tr>
            @endforeach
            </tbody>
          <tfoot>
            <tr>
              <th class="text-center">ID</th>
              <th class="text-center">{{ trans('message.list.name') }}</th>
              <th class="text-center">{{ trans('message.list.description') }}</th>
              <th class="text-center">{{ trans('message.list.action') }}</th>
            </tr>
          </tfoot>

          </table>

        </div>
      </div>
    </div>
  </div>
  
  @endsection
  @section('js')
  @endsection