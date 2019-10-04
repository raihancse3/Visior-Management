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
                        <div class="panel-title">Visitor List</div>
                        <div class="panel-options">
                             
                            <a href="{{ url('visitor/add') }}" class="bg"><i class="entypo-plus"></i>{{ trans('message.list.add_new') }}</a>
                        </div>
                    </div>
                    <!-- panel body -->
                    <div class="panel-body">  
                        <div class="col-md-5 col-md-offset-3">

                        <form class="form-inline" method="get" action="{{url('/visitors')}}">
                          <label class="sr-only" for="inlineFormInputName2">From</label>
                          <input type="text" class="form-control datepicker" name="from" placeholder="From" value="{{$from}}" required="true">

                          <label class="sr-only" for="inlineFormInputGroupUsername2">To</label>
                          <div class="input-group mb-2 mr-sm-2">
                            <input type="text" class="form-control datepicker" name="to" placeholder="To" value="{{$to}}" required="true">
                          </div>
                          <button type="submit" class="btn btn-primary mb-2">Submit</button>
                        </form>   

                        </div>
                        <br>
                         <br>
                          <br>
                        <table class="table table-bordered datatable text-center" id="table-4">
                            <thead>
                              <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Visitor ID</th>
                                <th class="text-center">Comapny Name</th>
                                <th class="text-center">Comapny Address</th>
                                <th class="text-center">Gender</th>
                                <th class="text-center">Position</th>
                                
                                <th class="text-center">Created At</th>
                                <th class="text-center">Picture</th>
                                <th class="text-center">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($visitors as $data)
                                  <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->username }}</td>
                                    
                                    <td>{{ $data->company_name }}</td>
                                    <td>{{ $data->company_address }}</td>
                                    <td>{{ $data->gender }}</td>
                                    <td>{{ $data->possition }}</td>
                                   
                                    <td>{{ date('d-m-Y',strtotime($data->created_at)) }}</td>
                                    <td>
                                     @if($data->picture)
                                      <img src="{{url("public/uploads/visitor/$data->picture")}}" height="60">
                                      @else
                                      <img src="{{url("public/uploads/avatar.jpg")}}" height="60">
                                      @endif  

                                    </td>

                                    <td>
                                    @if($data->status == 'In')
                                    <a href="{{url('visitor/exit/'.$data->id)}}" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-log-out" onclick="return confirm('Are you sure to exit?')"></i></a>
                                    @elseif($data->status == 'Out')

                                    <a href="{{url('visitor/entry/'.$data->id)}}" class="btn btn-xs btn-info">IN</a>                                        
                                    @else
                                    <a href="{{url('visitor/entry/'.$data->id)}}" class="btn btn-xs btn-info"></i>IN</a>
                                    @endif

                                    <a href="{{url('visitor/idcard/'.$data->id)}}" class="btn btn-xs btn-success" target="_blank">ID CARD</a>

                                    <a href="{{url('visitor/edit/'.$data->id)}}" class="btn btn-xs btn-warning">Edit</a>

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

$('.datepicker').datepicker({
autoclose: true,
todayHighlight: true,
format:'dd-mm-yyyy'
});          
        </script>
@endsection        