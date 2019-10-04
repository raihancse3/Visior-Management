@extends('layouts.app_admin')
@section('main')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <form class="form-horizontal" action="{{ url('report/sales-report') }}" method="GET">
        <div class="panel-body">
          <div class="col-md-3">
            <div class="form-group" style="margin-right: 5px;">
              <label for="exampleInputEmail1">{{ trans('message.form.from') }}</label>
                <input class="form-control" id="from" name="from" value="{{$from}}" type="text" required>
            </div>
          </div>
          
          <div class="col-md-3">
            <div class="form-group" style="margin-right: 5px;">
              <label for="exampleInputEmail1">{{ trans('message.form.to') }}</label>
                <input class="form-control" id="to" name="to" value="{{$to}}" type="text" required>
             
            </div>
          </div>
          <div class="col-md-2">
            <!-- /.form-group -->
            <div class="form-group" style="margin-right: 5px;">
              <label class="control-label">{{ trans('message.list.customer') }}</label>
              <select class="form-control select2" style="width: 100%;" name="customer_id" id="customer_id">
                <option value="">Select</option>
                @foreach($customers as $data)
                <option value="{{$data->id}}" <?= ($data->id==$customer_id) ? 'selected' : '' ?>>{{$data->name}}</option>
                @endforeach
              </select>
            </div>
            <!-- /.form-group -->
          </div>
          
          <div class="col-md-1">
            <div class="form-group">
              <label for="exampleInputEmail1">&nbsp;</label>
              <div class="input-group">
                <button type="submit" name="btn" class="btn btn-info btn-sm">{{ trans('message.form.submit') }}</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">{{ trans('message.menu.sales_report') }}</div>
        <div class="panel-options">
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
          <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
          <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
      </div>

  <div class="panel-body">
    <div class="table-responsive">
      <table id="purchaseList" class="table table-bordered">
        <thead>
          <tr class="bg-success">
            <th width="10%" class="text-center">{{ trans('message.list.date') }}</th>
            <th class="text-center">{{ trans('message.list.quantity') }}</th>
            <th class="text-center">{{ trans('message.list.sales_price') }}({{Session::get('currency_symbol')}})</th>
            <th class="text-center">{{ trans('message.list.cost_price') }}({{Session::get('currency_symbol')}})</th>
            <th width="10%" class="text-center">{{ trans('message.list.profit_loss') }}({{Session::get('currency_symbol')}})</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $qtyAmount = 0;
          $saleAmount = 0;
          $costAmount = 0;
          ?>
          @foreach($salesReportData as $data)
          <?php
          $qtyAmount +=$data->quanty;
          $saleAmount +=$data->sales;
          $costAmount +=$data->cost;
          ?>
          <tr>
            <td class="text-center">{{ date('d-m-Y',strtotime($data->date)) }}</td>
            <td class="text-center">{{ $data->quanty }}</td>
            <td class="text-center">{{ number_format($data->sales,2,'.',',') }}</td>
            <td class="text-center">{{ number_format($data->cost,2,'.',',') }}</td>
            <td class="text-center">{{ number_format($data->sales-$data->cost,2,'.',',') }}</td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
        <tr class="bg-success">
          <th class="text-center">TOTAL</th>
          <th class="text-center">{{$qtyAmount}}</th>
          <th class="text-center">{{ number_format($saleAmount,2,'.',',')}}</th>
          <th class="text-center">{{number_format($costAmount,2,'.',',')}}</th>
          <th class="text-center">{{number_format(($saleAmount-$costAmount),2,'.',',')}} </th>
        </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">

jQuery( document ).ready( function( $ ) {
var $purchaseList = jQuery( "#purchaseList" );
$purchaseList.DataTable( {
dom: 'Bfrtip',
buttons: [
'copyHtml5',
'excelHtml5',
'csvHtml5',
'pdfHtml5'
]
} );
} );

$('#from').datepicker({
autoclose: true,
todayHighlight: true,
format: 'dd-mm-yyyy'
});
$('#to').datepicker({
autoclose: true,
todayHighlight: true,
format: 'dd-mm-yyyy'
});
// Create pdf
$('#pdf').on('click', function(event){
event.preventDefault();
var from = $('#from').val();
var to = $('#to').val();
var customer_id = $('#customer_id').val();
window.location = SITE_URL+"/report/sales-report-pdf?from="+from+"&to="+to+"&customer_id="+customer_id;
});
$('#csv').on('click', function(event){
event.preventDefault();
var from = $('#from').val();
var to = $('#to').val();
var customer_id = $('#customer_id').val();
window.location = SITE_URL+"/report/sales-report-csv?from="+from+"&to="+to+"&customer_id="+customer_id;
});
</script>
@endsection