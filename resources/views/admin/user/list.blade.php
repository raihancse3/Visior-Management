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
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">{{ trans('message.list.users') }}</div>
                        <div class="panel-options">

                         @if(Helpers::has_permission(Auth::user()->id, 'add_user'))
                            <a href="{{ url('user/add') }}" class="bg"><span class="fa fa-plus"> &nbsp;</span>{{ trans('message.list.add_new') }}</a>
                          @endif

                            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                        </div>
                    </div>
                    <!-- panel body -->
                    <div class="panel-body">   
                        <table class="table table-bordered datatable text-center" id="table-4">
                            <thead>
                            <tr>
                            <th class="text-center">{{ trans('message.list.name') }}</th>
                            <th class="text-center">{{ trans('message.list.email') }}</th>
                            <th class="text-center">Employee Id</th>
                            <th class="text-center">Mobile</th>
                            <th class="text-center">Extension</th>
                            <th class="text-center">Department</th>
                            <th class="text-center">Section</th>
                            <th class="text-center">{{ trans('message.list.role') }}</th>
                            <th class="text-center">{{ trans('message.list.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($userList as $data)
                                  <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->emp_id }}</td>
                                    <td>{{ $data->mobile }}</td>
                                    <td>{{ $data->extension }}</td>
                                    <td>
                                      @if( $data->department)
                                      {{ $data->department->name }}
                                      @endif
                                    </td>
                                    <td>
                                      @if( $data->section)
                                      {{ $data->section->name }}
                                      @endif
                                    </td>
                                    <td>{{ $data->role->name}}</td>
                                    <td>
                                      <!-- <a href='{{ url("user/view/$data->id") }}' class="btn btn-xs btn-info"><i class="glyphicon glyphicon-eye-open"></i></a> -->

                                       @if(!in_array($data->id,[1]))
                                     @if(Helpers::has_permission(Auth::user()->id, 'edit_user'))
                                      <a href='{{ url("user/edit/$data->id") }}' class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
                                      @endif
                                      @endif
                                     
                                      @if(Helpers::has_permission(Auth::user()->id, 'delete_user'))
                                      @if($data->role_id != 1)
                                      <a href="{{url('user/delete/'.$data->id)}}" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete?')"></i></a>
                                      @endif
                                     
                                   @endif
                                    </td>
                                  </tr>
                                 @endforeach
                            </tbody>
                        </table>
                        <br />  
                    </div>
                </div>
            </div>
        </div>

   

@endsection
@section('js')
        <script type="text/javascript">
        jQuery( document ).ready( function( $ ) {
            var $table4 = jQuery( "#table-4" );
            
            $table4.DataTable( {
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