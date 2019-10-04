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
                        <div class="panel-title">Vehicle Movement List</div>
                    </div>
                    <!-- panel body -->
                    <div class="panel-body">   
                        <table class="table table-bordered datatable text-center" id="table-4">
                            <thead>
                              <tr>
                                <th class="text-center">Driver Name</th>
                                <th class="text-center">Vehicle No</th>
                                <th class="text-center">Mobile No</th>
                                <th class="text-center">Purpose</th>
                                <th class="text-center">Going To</th>
                                <th class="text-center">Back From</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Date</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($visitors as $data)
                                  <tr>
                                    <td>
                                        @if($data->driver)
                                        {{ $data->driver->name }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($data->vehicle)
                                        {{ $data->vehicle->vehicle_no }}
                                        @endif
                                    </td>

                                    <td>
                                        @if($data->driver)
                                        {{ $data->driver->mobile }}
                                        @endif
                                    </td>
                                     <td>
                                        @if($data->purpose)
                                        {{ $data->purpose }}
                                        @else
                                        -
                                        @endif
                                     </td>
                                    <td>
                                        
                                        @if($data->going_to)
                                        {{ $data->going_to }}
                                        @else
                                        -
                                        @endif

                                    </td>
                                    <td>
                                        @if($data->back_from)
                                        {{ $data->back_from }}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>
                                       
                                        @if($data->type=='IN')
                                        <span class="label label-info">IN</span>
                                        @else
                                        <span class="label label-danger">OUT</span>
                                        @endif

                                    </td>
                                    <td>{{ date('d-m-Y H:i:s',strtotime($data->created_at)) }}</td>
                                   
                                    
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