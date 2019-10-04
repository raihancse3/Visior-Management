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
                        <div class="panel-title">Visitor Movement List</div>
                    </div>
                    <!-- panel body -->
                    <div class="panel-body">   
                        <table class="table table-bordered datatable text-center" id="table-4">
                            <thead>
                              <tr>
                                <th class="text-center">Visitor Name</th>
                                <th class="text-center">Visitor ID</th>
                                <th class="text-center">Card No</th>
                                <th class="text-center">Company</th>
                                <th class="text-center">Contact Person</th>
                                <th class="text-center">Purpose</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Date</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($visitors as $data)
                                  <tr>
                                    <td>
                                        @if($data->visitor)
                                        {{ $data->visitor->name }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($data->visitor)
                                        {{ $data->visitor->username }}
                                        @endif
                                    </td>

                                    <td>
                                        @if($data->card_no)
                                        {{ $data->card_no }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($data->visitor)
                                        {{ $data->visitor->company_name }}
                                        @endif
                                    </td>                                    
                                     <td>
                                         @if($data->contact_user)
                                          {{ $data->contact_user->name }}
                                          @else
                                          -
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
                                        @if($data->type=='In')
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