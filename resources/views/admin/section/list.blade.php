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
        <div class="panel-title">Department of {{$department->name}}</div>
        <div class="panel-options">
          
          <a href="{{ url('section/add') }}/{{$department->id}}" class="bg"><i class="entypo-plus"></i>{{ trans('message.list.add_new') }}</a>
          
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
          <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
          <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
      </div>
      
      <div class="panel-body">
        <table id="list" class="table table-bordered text-center">
          <thead>
            <tr>
             
              <th class="text-center">{{ trans('message.list.name') }}</th>
              <th class="text-center">{{ trans('message.list.action') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($sections as $data)
            <tr">
          
              <td>{{ $data->name }}</td>
              <td>
                <a title="{{ trans('message.form.edit') }}" class="btn btn-xs btn-primary" href='{{ url("section_edit/$department->id/$data->id") }}'><i class="glyphicon glyphicon-edit"></i></a> &nbsp;

                <a href="{{url('section_delete/'.$data->id)}}" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete?')"></i></a>

              </td>
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  @endsection
  @section('js')
        <script type="text/javascript">
        jQuery( document ).ready( function( $ ) {
            var $list = jQuery( "#list" );
            
            $list.DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            } );
        } );        
        </script>
  @endsection