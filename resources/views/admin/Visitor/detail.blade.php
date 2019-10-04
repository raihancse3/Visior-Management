@extends('layouts.app_admin')
@section('main')
<div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary" data-collapsed="0">
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">{{$supplierInfo->name}}</div>
                        <div class="panel-options"> 
                            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                        </div>
                    </div>
                    <!-- panel body -->
                    <div class="panel-body">
                      <br>
                        <table class="table table-bordered datatable text-center" id="table-4">
                            <thead>
                              <tr>
                                <th class='text-center'>{{ trans('message.list.reference') }}</th>
                                <th class='text-center'>{{ trans('message.list.date') }}</th>
                                <th class='text-center'>{{ trans('message.list.total') }}({{Session::get('currency_symbol')}})</th>
                                <th class='text-center'>{{ trans('message.list.action') }}</th>
                              </tr>
                            </thead>
                            <tbody>
                  @foreach($supplierInfo->pusrchase_order as $item)
                  <tr id="rowid_{{$item->id}}">
                    <td>{{ PURCHASE.$item->reference }}</td>
                    <td>{{ date('d-m-Y',strtotime($item->date))}}</td>
                    <td>{{ number_format($item->total,2,'.',',') }}</td>
                    <td>
                        <a href='{{url("purchase/view/$item->id")}}' class="btn btn-xs btn-info"><i class="glyphicon glyphicon-eye-open"></i></a>

                        @if(Helpers::has_permission(Auth::user()->id, 'edit_purchase'))
                        <a href='{{url("purchase/edit/$item->id")}}' class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
                        @endif
                        @if(Helpers::has_permission(Auth::user()->id, 'delete_purchase'))
                        <a href="{{url('purchase/delete/'.$item->id)}}" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete?')"></i></a>
                        @endif
                    </td>
                  </tr>
                 @endforeach
                                
                            </tbody>
                            <tfoot>
                              
                              <tr>
                                <th class='text-center'>{{ trans('message.list.reference') }}</th>
                                <th class='text-center'>{{ trans('message.list.date') }}</th>
                                <th class='text-center'>{{ trans('message.list.total') }}({{Session::get('currency_symbol')}})</th>
                                <th class='text-center'>{{ trans('message.list.action') }}</th>
                              </tr>                              
                            </tfoot>
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