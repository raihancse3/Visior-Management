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
                        <div class="panel-title">Driver List</div>
                        <div class="panel-options">
                             
                            <a href="{{ url('driver/add') }}" class="bg"><i class="entypo-plus"></i>{{ trans('message.list.add_new') }}</a>
                        </div>
                    </div>
                    <!-- panel body -->
                    <div class="panel-body">   
                        <table class="table table-bordered datatable text-center" id="table-4">
                            <thead>
                              <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Mobile No</th>
                                <th class="text-center">Emp Id</th>
                                <th class="text-center">Vehicle No</th>
                                <th class="text-center">Picture</th>
                                <th class="text-center">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($visitors as $data)
                                  <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->mobile }}</td>
                                    <td>{{ $data->emp_id }}</td>
                                    <td>
                                        @if($data->vehicle)
                                        {{ $data->vehicle->vehicle_no }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($data->picture)
                                        
                                        <img src="{{url("public/uploads/driver/$data->picture")}}" alt='No Image' height='50'>
                                        @endif
                                    </td>
                                    <td>
                                        
                                    @if($data->status == 'IN')
                                    
                                    <a href="{{url('driver/exit_entry/'.$data->id)}}" class="btn btn-xs btn-success">Exit Entry</a>

                                    @elseif($data->status == 'OUT')

                                    <a href="{{url('driver/return_entry/'.$data->id)}}" class="btn btn-xs btn-info">Return Entry</a>                                        
                                    @else
                                    <a href="{{url('driver/exit_entry/'.$data->id)}}" class="btn btn-xs btn-success">Exit Entry</a>
                                    @endif                                    

                                    <a href="{{url('driver/edit/'.$data->id)}}" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i></a>      

                                    <a href="{{url('driver/idcard/'.$data->id)}}" class="btn btn-xs btn-danger" target="_blank">ID CARD</a>                                  
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